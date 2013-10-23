<?php

/**
 * This is the model class for table "admin_Notice".
 *
 * The followings are the available columns in table 'admin_Notice':
 * @property string $id
 * @property string $time
 * @property string $content
 * @property string $count
 * @property string $createTime
 * @property string $updateTime
 */
class Notice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notice the static model class
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
		return 'admin_Notice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, time', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, time, content, count, createTime, updateTime', 'safe', 'on'=>'search'),
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
			'id' => '推送ID',
			'time' => '推送时间',
			'content' => '推送内容',
			'count' => '已推送数量',
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
		$criteria->compare('time',$this->time,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('count',$this->count,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function sendNotice($count=9999)
    {
        $now = time();
        $sql = "select `id`, `content`, `count` from admin_Notice where time<=$now order by time asc";
        $db = Yii::app()->db;
        $results = $db->createCommand($sql)->queryAll();
        if (empty($results)) {
            return ;
        }

        foreach ($results as $result) {
            $sql = "select max(id) from device where token!=''";
            $searchResult = $db->createCommand($sql)->queryRow();
            $maxUserId = $searchResult['max(id)'];
            if ($maxUserId=intval($maxUserId) <= intval($result['count'])) {
                return true;
            }

            $lastSendUserId = intval($result['count']);
            $sub = 1;
            while($sub<$count && $maxUserId>$lastSendUserId){
                $sql = "selectt id, token from `device` where id>$lastSendUserId and id<=$maxUserId and token!='' order by id asc LIMIT 0,".NOTIFICATION_CRON_COUNT;
                $users = $db->createCommand($sql)->queryAll();
                $lastSendUserId = ($lastSendUserId+NOTIFICATION_CRON_COUNT > $maxUserId) ? $maxUserId : ($lastSendUserId+NOTIFICATION_CRON_COUNT);
                if (!empty($users)) {
                    $pushNotifications = array();
                    $content = array(
                        'aps' => array(
                            'alert' => $result['content'],
                            'badge' => 1,
                        )
                    );
                    foreach ($users as $val) {
                        $pushNotifications[] = array(
                            'userId' => $var['id'],
                            'token' => $val['token'],
                            'content' => $content,
                        );
                    }
                    APNS::pushNotification($pushNotifications, APPLE_NOTIFICATION_SANDBOX, 0);

                    $lastUser = end($users);
                    $lastSendUserId = ($lastUser['userId'] > $lastSendUserId) ? $lastUser['userId'] : $lastSendUserId;
                }

                $sql = "update admin_Notice set count=$lastSendUserId where id=".$result['id'];
                $db->createCommand($sql)->execute();
                $sub++;
            }
            if ($lastSendUserId >= $maxUserId) {
                Notice::model()->deleteByPk($result['id']);
            }
        }
    }
}
