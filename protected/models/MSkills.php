<?php

/**
 * This is the model class for table "skills".
 *
 * The followings are the available columns in table 'skills':
 * @property string $id
 * @property string $playerId
 * @property integer $skillId
 * @property integer $level
 * @property string $createTime
 * @property string $updateTime
 */
class MSkills extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MSkills the static model class
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
		return 'skills';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('playerId, skillId, createTime, updateTime', 'required'),
			array('skillId, level', 'numerical', 'integerOnly'=>true),
			array('playerId, createTime', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, playerId, skillId, level, createTime, updateTime', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'playerId' => 'Player',
			'skillId' => 'Skill',
			'level' => 'Level',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('playerId',$this->playerId,true);
		$criteria->compare('skillId',$this->skillId);
		$criteria->compare('level',$this->level);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}