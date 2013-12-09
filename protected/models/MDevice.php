<?php

/**
 * This is the model class for table "device".
 */
class MDevice extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MDevice the static model class
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
        return 'device';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array();
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
     * Register by uid.
     * A player will be created and its playerId will be binden to uid.
     * 
     * @param string $uid The uid of user.
     * @return MPlayer The registered player.
     */
    public function register($name, $inviterId, $term, $os)
    {
        $player = new MPlayer();
        $player->name = $name;
        $player->createTime = time();
        $player->inviteCode = $this->createInviteCode();
        $player->inviterId = $inviterId;
        $player->save();

        //events
        $this->onRegister = array($player, 'initialize');
        $this->onRegister = array($player, 'rewardInviter');
        //$this->onRegister = array($player, 'rewardPaytoDownload');

        $this->playerId = $player->playerId;
        $this->terminal = $term;
        $this->os = $os;
        $this->save();

        $this->onRegister(new CEvent()); 

        return $player;
    }

    public function onRegister($event)
    {
        $this->raiseEvent('onRegister', $event);
    }

    public static function setToken($deviceId, $token = '') {
        $obj = new MDevice();
        $row = $obj->findByAttributes(array('uid' => $deviceId));
        if (!isset($row)) {
            $obj = new Token();
            $row = $obj->findByAttributes(array('deviceId' => $deviceId));
            if (!isset($row)) {
                $obj->deviceId = $deviceId;
                $obj->token = $token;
                $obj->createTime = time();
                $obj->save();
            }
            else {
                $row->token = $token;
                $row->saveAttributes(array('token'));
            }
            return;
        }

        $row->token = $token;
        $row->saveAttributes(array('token'));
    }

    public static function setDevice($id, $device, $os, $version)
    {
        $device = MDevice::model()->findByPk($id);
        $device->device = $device;
        $device->os = $os;
        $device->version = $version;

        $device->save();
    }

    public function createInviteCode()
    {
        do {
            $str='abcdefghijklmnopqrstuvwxyz0123456789';
            $str_temp=str_shuffle($str);
            $code = substr($str_temp, 0, PLAYER_INVITECODE_LENGTH); 
            $isExist = Yii::app()->db->createCommand("SELECT playerId FROM player WHERE inviteCode=:code")->bindValue(':code', $code)->queryScalar();
        } while ($isExist);

        return $code;
    }
}
