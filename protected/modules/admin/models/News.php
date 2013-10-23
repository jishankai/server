<?php

/**
 * This is the model class for table "admin_News".
 *
 * The followings are the available columns in table 'admin_News':
 * @property string $id
 * @property string $title_jp
 * @property string $title_en
 * @property string $title_zh
 * @property string $content_jp
 * @property string $content_en
 * @property string $content_zh
 * @property integer $isTop
 * @property string $statusTime
 * @property string $createTime
 * @property string $updateTime
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'admin_News';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    //array('title_jp, title_en, title_zh, content_jp, content_en, content_zh, statusTime, updateTime', 'required'),
			array('isTop', 'numerical', 'integerOnly'=>true),
			array('title_jp, title_en, title_zh', 'length', 'max'=>255),
			array('startTime, endTime, createTime', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title_jp, title_en, title_zh, content_jp, content_en, content_zh, isTop, startTime, endTime,  createTime, updateTime', 'safe', 'on'=>'search'),
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
			'id' => '新闻ID',
			'title_jp' => "日文标题",
			'title_en' => "英文标题",
			'title_zh' => "中文标题",
			'content_jp' => "日文内容",
			'content_en' => "英文内容",
			'content_zh' => "中文内容",
			'isTop' => "是否置顶",
			'startTime' => "开始时间",
			'endTime' => "结束时间",
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
		$criteria->compare('title_jp',$this->title_jp,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('title_zh',$this->title_zh,true);
		$criteria->compare('content_jp',$this->content_jp,true);
		$criteria->compare('content_en',$this->content_en,true);
		$criteria->compare('content_zh',$this->content_zh,true);
		$criteria->compare('isTop',$this->isTop);
		$criteria->compare('startTime',$this->startTime,true);
		$criteria->compare('endTime',$this->endTime,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getMd5($lang)
    {
        $time = time();
        $all = Yii::app()->db->createCommand("SELECT id, title_$lang, content_$lang, isTop, startTime, endTime FROM admin_News WHERE $time>=startTime AND $time<endTime")->queryAll();
        $strings = array();
        foreach ($all as $single) {
            $strings[] = implode('_', $single);
        }

        return md5(implode(',', $strings));
    }

    public function getListMd5($lang)
    {
        $time = time();
        $all = Yii::app()->db->createCommand("SELECT id, title_$lang, content_$lang, isTop, startTime, endTime FROM admin_News WHERE $time>=startTime AND $time<endTime")->queryAll();
        $result = array();
        foreach ($all as $single) {
            $result[$single['id']] = md5(implode('_', $single));
        }

        return $result;
    }
}
