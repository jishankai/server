<?php

/**
 * This is the model class for table "admin_PlayerSummary".
 *
 * The followings are the available columns in table 'admin_PlayerSummary':
 * @property string $date
 * @property string $dnu
 * @property string $dau
 * @property string $ydau
 * @property string $total
 * @property string $vip_today
 * @property string $vip_increase
 * @property string $vip_total
 * @property string $createTime
 * @property string $updateTime
 */
class PlayerSummary extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PlayerSummary the static model class
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
        return 'admin_PlayerSummary';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('date, dnu, dau, ydau, total, vip_today, vip_increase, vip_total, createTime, updateTime', 'required'),
            array('date, dnu, dau, ydau, total, vip_today, vip_increase, vip_total, createTime', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('date, dnu, dau, ydau, total, vip_today, vip_increase, vip_total, createTime, updateTime', 'safe', 'on'=>'search'),
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
            'dnu' => 'Dnu',
            'dau' => 'Dau',
            'ydau' => 'Ydau',
            'total' => 'Total',
            'vip_today' => 'Vip Today',
            'vip_increase' => 'Vip Increase',
            'vip_total' => 'Vip Total',
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
        $criteria->compare('dnu',$this->dnu,true);
        $criteria->compare('dau',$this->dau,true);
        $criteria->compare('ydau',$this->ydau,true);
        $criteria->compare('total',$this->total,true);
        $criteria->compare('vip_today',$this->vip_today,true);
        $criteria->compare('vip_increase',$this->vip_increase,true);
        $criteria->compare('vip_total',$this->vip_total,true);
        $criteria->compare('createTime',$this->createTime,true);
        $criteria->compare('updateTime',$this->updateTime,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
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

    public function getActivePlayerPercent($data)
    {
        if ($data["scoreNum"]==0) {
            return NULL;
        } else {
            return sprintf('%.2f%%', ($data["activeNum"]*100)/$data["scoreNum"]); 
        }
    }

    public function getUnActivePlayerPercent($data)
    {
        if ($data["scoreNum"]==0) {
            return NULL;
        } else {
            return sprintf('%.2f%%', ($data["unActiveNum"]*100)/$data["scoreNum"]); 
        }
    }

    public function getPropsType($propsId)
    {
        $props = Util::loadConfig("props");
        return $props[$propsId]["type"]==0?"非战斗类":"战斗类";
    }

    public function getPropsName($propsId)
    {
        $props = Util::loadConfig("props");
        return $props[$propsId]["name"];
    }

    public function getPropsOperate($operateId)
    {
        switch ($operateId) {
        case PROPS_OPERATE_USE:
            return "使用";
            break;

        case PROPS_OPERATE_BUY:
            return "购买";
            break;
        case PROPS_OPERATE_EXCHANGE:
            return "兑换";
            break;

        case PROPS_OPERATE_SENT:
            return "赠送";
            break;
        case PROPS_OPERATE_MAIL:
            return "系统";
            break;
        default:
            // code...
            break;
        }
    }
}
