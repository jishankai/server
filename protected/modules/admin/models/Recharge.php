<?php

/**
 * This is the model class for table "admin_Recharge".
 *
 * The followings are the available columns in table 'admin_Recharge':
 * @property string $date
 * @property string $playerId
 * @property string $dollar
 * @property string $jpy
 * @property string $product_id
 * @property string $createTime
 * @property string $updateTime
 */
class Recharge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Recharge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_Recharge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, playerId, dollar, jpy, product_id, createTime, updateTime', 'required'),
			array('date, playerId, dollar, jpy, createTime', 'length', 'max'=>10),
			array('product_id', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('date, playerId, dollar, jpy, product_id, createTime, updateTime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'date' => 'Date',
			'playerId' => 'Player',
			'dollar' => 'Dollar',
			'jpy' => 'Jpy',
			'product_id' => 'Product',
			'createTime' => 'Create Time',
			'updateTime' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('date',$this->date,true);
		$criteria->compare('playerId',$this->playerId,true);
		$criteria->compare('dollar',$this->dollar,true);
		$criteria->compare('jpy',$this->jpy,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function weekTime()
	{
		$time = time();
		$return = array();
		//判断当天是星期几，0表星期天，1表星期一，6表星期六
		$w_day=date("w",$time);
		
		//php处理当前星期时间点上，根据当天是否为星期一区别对待
		if($w_day=='1'){
			$cflag = '+0';
			$lflag = '-1';
		}
		else {
			$cflag = '-1';
			$lflag = '-2';
		}
		
		//本周一零点的时间戳,从00:00:00
		$return['weekStartTime'] = strtotime(date('Y-m-d',strtotime("$cflag week Monday", $time)));
		//本周末零点的时间戳,到23:59:59
		$return['weekEndTime'] = strtotime(date('Y-m-d',strtotime("$cflag week Monday", $time)))+7*24*3600-1;
		
		//上周一零点的时间戳,从00:00:00
		$return['preWeekStartTime'] = strtotime(date('Y-m-d',strtotime("$lflag week Monday", $time)));
		//上周末零点的时间戳,到23:59:59
		$return['preWeekEndTime'] = strtotime(date('Y-m-d',strtotime("$lflag week Monday", $time)))+7*24*3600-1;
		
		return $return;
	}
	
	public function monthTime()
	{
		$return = array();
		$year = $lastMonthYear = $nextMonthYear = date('Y');
		$month = date('m');
		$lastMonth = date('m') - 1;
		$nextMonth = date('m') + 1;
		
		//当前月为1月时,上月为上一年12月
		if($month == 1){
			$lastMonth = 12;
			$lastMonthYear--;
		}
		
		//当前月为12月时,下月为下一年1月
		if($month == 12){
			$nextMonth = 1;
			$nextMonthYear++;
		}
		
		//本月开始时间
		$return['monthStartTime'] = strtotime(date($year.'-'.$month));
		//本月结束时间
		$return['monthEndTime'] = strtotime(date($nextMonthYear.'-'.$nextMonth)) - 1;
		
		//上月开始时间
		$return['preMonthStartTime'] = strtotime(date($lastMonthYear.'-'.$lastMonth));
		//上月结束时间
		$return['preMonthEndTime'] = strtotime(date($year.'-'.$month)) - 1;
		
		return $return;
	}
	
	public function sortByPlayerId($array)//特用在SDailyRechargeController中对查询的数据变成以playerId为key的数组
	{
		$temp = array();
		foreach($array as $value){
			$temp[$value['playerId']] = $value;
		};
		return $temp;
	}
	
	public function combine($recharge, $search, $week, $preWeek, $month, $preMonth, $todayRecharge, $conToday)
	{
		$combine = array();
		
		foreach($recharge as $key => $value){
			$combine[$key]['playerId'] = $value['playerId'];
			$combine[$key]['name'] = $value['name'];
			$combine[$key]['loginTime'] = $value['loginTime'];
				
			//判断key是否存在
			$searchExist = array_key_exists($key, $search);
			$weekExist = array_key_exists($key, $week);
			$preWeekExist = array_key_exists($key, $preWeek);
			$monthExist = array_key_exists($key, $month);
			$preMonthExist = array_key_exists($key, $preMonth);
			$todayRechargeExist = array_key_exists($key, $todayRecharge);
			
			//填充查询时段内充值
			if($searchExist){
				$combine[$key]['searchDollar'] = $search[$key]['searchDollar'];
				$combine[$key]['searchRMB'] = $search[$key]['searchRMB'];
			}else{
				$combine[$key]['searchDollar'] = 0;
				$combine[$key]['searchRMB'] = 0;
			}
			
			//填充本周充值
			if($weekExist){
				$combine[$key]['weekDollar'] = $week[$key]['weekDollar'];
				$combine[$key]['weekRMB'] = $week[$key]['weekRMB'];
			}else{
				$combine[$key]['weekDollar'] = 0;
				$combine[$key]['weekRMB'] = 0;
			}
			
			//填充上周充值
			if($preWeekExist){
				$combine[$key]['preWeekDollar'] = $preWeek[$key]['preWeekDollar'];
				$combine[$key]['preWeekRMB'] = $preWeek[$key]['preWeekRMB'];
			}else{
				$combine[$key]['preWeekDollar'] = 0;
				$combine[$key]['preWeekRMB'] = 0;
			}
			
			//填充本月充值
			if($monthExist){
				$combine[$key]['monthDollar'] = $month[$key]['monthDollar'];
				$combine[$key]['monthRMB'] = $month[$key]['monthRMB'];
			}else{
				$combine[$key]['monthDollar'] = 0;
				$combine[$key]['monthRMB'] = 0;
			}
			
			//填充上月充值
			if($preMonthExist){
				$combine[$key]['preMonthDollar'] = $preMonth[$key]['preMonthDollar'];
				$combine[$key]['preMonthRMB'] = $preMonth[$key]['preMonthRMB'];
			}else{
				$combine[$key]['preMonthDollar'] = 0;
				$combine[$key]['preMonthRMB'] = 0;
			}
			
			//如果查询日期包含今天,填充加上今天数据
			if($conToday && $todayRechargeExist){
				$combine[$key]['searchDollar'] += $todayRecharge[$key]['todayUS'];
				$combine[$key]['searchRMB'] += $todayRecharge[$key]['todayRMB'];
			}
			
			//填充加上今天数据
			if($todayRechargeExist){
				$combine[$key]['weekDollar'] += $todayRecharge[$key]['todayUS'];
				$combine[$key]['weekRMB'] += $todayRecharge[$key]['todayRMB'];
				$combine[$key]['monthDollar'] += $todayRecharge[$key]['todayUS'];
				$combine[$key]['monthRMB'] += $todayRecharge[$key]['todayRMB'];
			}
		}
		
		return $combine;
	}
	
	public function array_sort($arr, $keys, $type = 'asc'){ 
		$keysvalue = $new_array = array();
		foreach ($arr as $k => $v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $k => $v){
			$new_array[$k] = $arr[$k];
		}
		return $new_array; 
	}
	
	public function compareDate($date){
		$date = strtotime(date('Y-m-d', $date));
		$currentDay = strtotime(date('Y-m-d', time()));//当前日期
		$dayDiff = (int)(($currentDay - $date)/3600/24);
		if($dayDiff >= 0 && $dayDiff <= 1){
			return 'color0';
		}else if($dayDiff >= 2 && $dayDiff <= 3){
			return 'color1';
		}else if($dayDiff >= 4 && $dayDiff <= 6){
			return 'color2';
		}else if($dayDiff >= 7 && $dayDiff <= 13){
			return 'color3';
		}else if($dayDiff >= 14){
			return 'color4';
		}
	}

    public function record($event)
    {
        $iap = $event->sender;

        $time = time();
        $date = strtotime(date('Y-m-d', $time));
        $week = date('W', $date);
        $month = date('n', $date);
        Yii::app()->db->createCommand("
            insert ignore into admin_Recharge
            (date, playerId, week, month, rmb, dollar, jpy, product_id, createTime)
            values
            ($date, $iap->playerId, $week, $month, $iap->price, $iap->dollar, $iap->jpy, '$iap->product_id', $time)"
        )->execute();
    }
}
