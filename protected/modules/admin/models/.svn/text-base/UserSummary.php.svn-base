<?php

/**
 * This is the model class for table "admin_UserSummary".
 *
 * The followings are the available columns in table 'admin_UserSummary':
 * @property string $date
 * @property string $increase
 * @property string $register
 * @property string $createTime
 * @property string $updateTime
 */
class UserSummary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserSummary the static model class
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
		return 'admin_UserSummary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, increase, register, createTime, updateTime', 'required'),
			array('date, increase, register, createTime', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('date, increase, register, createTime, updateTime', 'safe', 'on'=>'search'),
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
			'increase' => 'Increase',
			'register' => 'Register',
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
		$criteria->compare('increase',$this->increase,true);
		$criteria->compare('register',$this->register,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
    }

    public function getOsPercent($data, $osCount)//data为当前数据,$osCount为所有os数据总和
	{
		return sprintf('%.2f%%', ($data["osNum"]*100)/$osCount);
	}
	
	public function getTerminalPercent($data, $terminalCount)//data为当前数据,$osCount为所有os数据总和
	{
		return sprintf('%.2f%%', ($data["terminalNum"]*100)/$terminalCount);
	}
	
	public function getMixPercent($data, $mixCount)//data为当前数据,$osCount为所有os数据总和
	{
		return sprintf('%.2f%%', ($data["mixNum"]*100)/$mixCount);
	}
	
	public function getMixName($data)//data为当前数据,$osCount为所有os数据总和
	{
		return $data["os"].$data["terminal"];
	}
	
    public function getCompareByKey($data, $key)
    {
		$pre = $data['pre'];
		if($data[$key] == ''){
			return $data[$key];
		}
		if(!empty($pre)){
			if($data[$key] > $pre[$key]){
				echo $data[$key].'↑';
			}else if($data[$key] < $pre[$key]){
				echo $data[$key].'↓';
			}else{
				echo $data[$key];
			}
		}else{
			echo $data[$key];
		}
	}
	
    public function getBackgroundByKey($data, $key)
    {
		$pre = $data['pre'];
		if($data[$key] == ''){
			return '';
		}
		if(!empty($pre)){
			if($data[$key] > $pre[$key]){
				return 'green';
			}else if($data[$key] < $pre[$key]){
				return 'red';
			}
		}
	}
}
