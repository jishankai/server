<?php

/**
 * This is the model class for table "field".
 *
 * The followings are the available columns in table 'field':
 * @property string $playerId
 * @property string $scepter_1
 * @property string $scepter_2
 * @property string $scepter_3
 * @property string $scepter_4
 * @property string $ring_1
 * @property string $ring_2
 * @property string $ring_3
 * @property string $ring_4
 * @property string $createTime
 * @property string $updateTime
 */
class MField extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'field';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('createTime', 'required'),
			array('playerId', 'length', 'max'=>11),
			array('scepter_1, scepter_2, scepter_3, scepter_4, ring_1, ring_2, ring_3, ring_4, createTime', 'length', 'max'=>10),
			array('updateTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('playerId, scepter_1, scepter_2, scepter_3, scepter_4, ring_1, ring_2, ring_3, ring_4, createTime, updateTime', 'safe', 'on'=>'search'),
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
			'scepter_1' => 'Scepter 1',
			'scepter_2' => 'Scepter 2',
			'scepter_3' => 'Scepter 3',
			'scepter_4' => 'Scepter 4',
			'ring_1' => 'Ring 1',
			'ring_2' => 'Ring 2',
			'ring_3' => 'Ring 3',
			'ring_4' => 'Ring 4',
			'createTime' => 'Create Time',
			'updateTime' => 'Update Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('playerId',$this->playerId,true);

		$criteria->compare('scepter_1',$this->scepter_1,true);

		$criteria->compare('scepter_2',$this->scepter_2,true);

		$criteria->compare('scepter_3',$this->scepter_3,true);

		$criteria->compare('scepter_4',$this->scepter_4,true);

		$criteria->compare('ring_1',$this->ring_1,true);

		$criteria->compare('ring_2',$this->ring_2,true);

		$criteria->compare('ring_3',$this->ring_3,true);

		$criteria->compare('ring_4',$this->ring_4,true);

		$criteria->compare('createTime',$this->createTime,true);

		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider('MField', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return MField the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}