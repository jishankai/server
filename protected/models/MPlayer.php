<?php

/**
 * This is the model class for table "player".
 */
class MPlayer extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MPlayer the static model class
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
        return 'player';
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

    public function behaviors()
    {
        return array(
            'armsManager' => array(
                'class' => 'MArmsManager'
            ),
            'accessoriesManager' => array(
                'class' => 'MAccessoriesManager'
            ),
            'skillsManager' => array(
                'class' => 'MSkillsManager'
            ),
            'weaponsManager' => array(
                'class' => 'MWeaponsManager'
            ),
            'pointManager' => array(
                'class' => 'MPointManager'
            ),
            'propsManager' => array(
                'class' => 'MPropsManager'
            ),
            'loginManager' => array(
                'class' => 'MLoginManager'
            ),
            'mailManager' => array(
                'class' => 'MMailManager'
            ),
            'processManager' => array(
                'class' => 'MProcessManager'
            ),
        );
    }

    public function initialize($event)
    {
        $this->coin = 1000;
        $this->jewel = 100;
        $this->saveAttributes(array('coin', 'jewel'));
        $this->initLogin();
        $this->initPoint();
        //$this->initProps();
        $this->initArms();
        $this->initWeapon();
        $this->initSkills();
        $this->initProcess();
    }

    public function clear()
    {
        MLogin::model()->deleteByPk($this->playerId);
        MPoint::model()->deleteByPk($this->playerId);
        MArms::model()->deleteByPk($this->playerId);
        MAccessories::model()->deleteByPk($this->playerId);
        MSkills::model()->deleteByPk($this->playerId);
        MWeapons::model()->deleteByPk($this->playerId);
        MMail::model()->deleteAllByAttributes(array('playerId'=>$this->playerId));
        MProcess::model()->deleteAllByAttributes(array('playerId'=>$this->playerId));
        MProps::model()->deleteAllByAttributes(array('playerId'=>$this->playerId));

        $this->delete();
    }

    public function rewardInviter($event)
    {
        Yii::app()->db->createCommand('UPDATE player SET inviteCount=inviteCount+1 WHERE playerId=:playerId')->bindValue(':playerId', $this->inviterId)->execute();

        $inviter = MPlayer::model()->findByPk($this->inviterId);
        if (isset($inviter)) {
            //$inviter->update();
            $inviterRewards = Util::loadConfig('inviterRewards');
            if (isset($inviterRewards[$inviter->inviteCount])) {
                $gift = $inviterRewards[$inviter->inviteCount];
                $giftDetail = explode('_', $gift);
                //$props = Util::loadConfig('props');
                //$desc = $props[$giftDetail[0]]['desc'].'\n 招待'.$inviter->inviteCount.'人获取的奖励';
                $desc = '邀请'.$inviter->inviteCount.'人获取的奖励';
                MMail::model()->create($this->inviterId, $desc, $gift);
            }
        }
    }

    public function rewardPaytoDownload($event)
    {
        $setting = Util::loadConfig('paytoDownloadRewards');
        $startTime = strtotime($setting['startTime']);
        $endTime = strtotime($setting['endTime']);
        $device = MDevice::model()->findByAttributes(array('playerId'=>$this->playerId));
        if ($device->createTime>=$startTime and $device->createTime<$endTime) {
            $rewards = $setting['rewards'];
            $propsSet = explode(',', $rewards);
            foreach ($propsSet as $props) {
                $desc = "付费下载应援大礼包";
                MMail::model()->create($this->playerId, $desc, $props); 
            }
        }
    }

    public function getPlayerIdByCode($inviteCode)
    {
        return Yii::app()->db->createCommand("SELECT playerId FROM player WHERE inviteCode=:inviteCode")->bindValue(':inviteCode', $inviteCode)->queryScalar();
    }

    public function onLogin($event)
    {
        $this->raiseEvent('onLogin', $event);
    }

    public function isNameExist($name)
    {
        return Yii::app()->db->createCommand('SELECT playerId FROM player WHERE name=:name')->bindValue(':name', $name)->queryScalar();
    }

    protected function updateLogin($event)
    {
        $login = $event->sender->getLogin();
        $currentTime = time();
        if (!isset($login->loginTime) or Util::getDayTime($currentTime)>Util::getDayTime($login->loginTime)) {
            if (isset($login->total)) {
                $login->total++;
            } else {
                $login->total = 1;
            }

            if (isset($login->loginTime) && Util::getDayTime($login->loginTime)==Util::getDayTime(strtotime('-1 days', $currentTime))) {
                $login->duration++;
            } else {
                $login->duration = 1;
            }
        }
        $login->loginTime = $currentTime;
        $login->save();
    }

    protected function summaryLogin($event)
    {
        $date = strtotime(date('Y/m/d'));
        $month = strtotime(date('Y-m',$date));
        $loginSummary = LoginSummary::model()->findByPk(array('playerId'=>$this->playerId, 'date'=>$date));
        if (empty($loginSummary)) {
            $loginSummary = new LoginSummary;
            $loginSummary->playerId = $this->playerId;
            $loginSummary->date = $date;
            $loginSummary->month = $month;
            $loginSummary->createTime = time();
            $loginSummary->save();
        }
    }

    protected function checkLoginRewards($event)
    {
        /*
        $today = date("Y-m-d 00:00:00", time()); 
        $loginDay = date("Y-m-d 00:00:00", $this->getLogin()->loginTime); 
        $registerDay = date("Y-m-d 00:00:00", $this->getLogin()->createTime);
        $tTime = strtotime($today);
        $lTime = strtotime($loginDay);
        $rTime = strtotime($registerDay);
        if ($this->getLogin()->loginTime==0 or ($tTime-$rTime<60*60*24*7 && $tTime!=$lTime)) {
            if ($this->getLogin()->loginTime==0) {
                $day = 1;
            } else {
                $day = intval(($tTime-$rTime)/(60*60*24))+1;
            }
            $rewards = Util::loadConfig('loginRewards');
            $propsSet = explode(',', $rewards[$day]);
            foreach ($propsSet as $props) {
                $desc = "新用户登陆奖励$day";
                MMail::model()->create($this->playerId, $desc, $props); 
            }
        }
         */
    }

    public function getS1()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>1));
    }
    public function getS2()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>2));
    }
    public function getS3()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>3));
    }
    public function getS4()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>4));
    }
    public function getS5()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>5));
    }
    public function getS6()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>6));
    }
    public function getS7()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>7));
    }
    public function getS8()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>8));
    }
    public function getS9()
    {
        return MArms::model()->findByAttributes(array('playerId'=>$this->playerId, 'armId'=>9));
    }
}
