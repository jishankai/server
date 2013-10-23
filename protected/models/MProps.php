<?php

/**
 * This is the model class for table "props".
 */
class MProps extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MProps the static model class
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
        return 'props';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
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

    public static function createProps($playerId, $propsId, $num, $operate)
    {
        $props = MProps::model()->findByAttributes(array('playerId'=>$playerId, 'propsId'=>$propsId));
        if (isset($props)) {
            if ($props->num+$num > PROPS_NUM_MAX) {
                return MAIL_NOTRECEIVED;
            }
            $props->num += $num;
            $props->saveAttributes(array('num'));
        } else {
            $props = new MProps;
            $props->playerId = $playerId;
            $props->propsId = $propsId;
            $props->num = $num;
            $props->createTime = time();
            $props->save();
        }

        $propsLog = new MPropsLog;
        $propsLog->playerId = $playerId;
        $propsLog->propsId = $propsId;
        $propsLog->num = $num;
        $propsLog->operate = $operate;
        $propsLog->createTime = time();
        $propsLog->save();

        return MAIL_RECEIVED;
    }

    public static function useProps($playerId, $propsId, $num, $operate=PROPS_OPERATE_USE)
    {
        $props = MProps::model()->findByAttributes(array('playerId'=>$playerId, 'propsId'=>$propsId));
        if (isset($props) && $props->num>=$num) {
            $props->num -= $num;
            $props->saveAttributes(array('num'));
        } else {
            throw new MException("道具数量不足");
        }

        $propsLog = new MPropsLog;
        $propsLog->playerId = $playerId;
        $propsLog->propsId = $propsId;
        $propsLog->num = $num;
        $propsLog->operate = $operate;
        $propsLog->createTime = time();
        $propsLog->save();

        return $props->num;
    }

    //首充送礼活动
    public function rewardNewBuyer($event)
    {
        $iap = $event->sender;
        
        $player = MPlayer::model()->findByPk($iap->playerId); 
        if ($player->getData()->isCharged == 0) {
            $r = Yii::app()->db->createCommand("UPDATE data SET isCharged=1 WHERE playerId=$iap->playerId AND isCharged=0")->execute();
            if ($r) {
                $desc = "首次消费得好礼";
                MMail::model()->create($iap->playerId, $desc, $iap->props); 
                MMail::model()->create($iap->playerId, $desc, PROPS_CP_ID.'_1'); 
                MMail::model()->create($iap->playerId, $desc, PROPS_LINE_ID.'_5'); 
                MMail::model()->create($iap->playerId, $desc, PROPS_STONE_ID.'_5'); 
            }            
        }
    }
}
