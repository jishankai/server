<?php

/**
 * This is the model class for table "admin_PlayerLoginMonth".
 *
 * The followings are the available columns in table 'admin_PlayerLoginMonth':
 * @property string $playerId
 * @property string $loginMonth
 * @property string $loginDetail
 * @property string $createTime
 * @property string $updateTime
 */
class PlayerLoginMonth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PlayerLoginMonth the static model class
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
		return 'admin_PlayerLoginMonth';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('playerId, loginMonth', 'required'),
			array('playerId, loginMonth, loginDetail, createTime', 'length', 'max'=>10),
			array('updateTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('playerId, loginMonth, loginDetail, createTime, updateTime', 'safe', 'on'=>'search'),
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
			'playerId' => 'Player',
			'loginMonth' => 'Login Month',
			'loginDetail' => 'Login Detail',
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

		$criteria->compare('playerId',$this->playerId,true);
		$criteria->compare('loginMonth',$this->loginMonth,true);
		$criteria->compare('loginDetail',$this->loginDetail,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}