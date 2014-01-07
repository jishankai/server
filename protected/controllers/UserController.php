<?php

class UserController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            //'checkSig',
        );    
    }

    public function actionLoginApi($uid, $ver, $token=NULL)
    {
        $device = MDevice::model()->findByAttributes(array('uid'=>$uid));
        $isVerify = ($ver==APP_VERSION_VERIFY);
        if(empty($device->playerId)){
            if($device === null){
                $device = new MDevice();
                $device->uid = $uid;
                $device->token = $token;
                $device->createTime = time();
                $device->save();
            }
            $session = Yii::app()->session;
            $session['id'] = $device->id;
            $this->echoJsonData(array(
                'result'=>false, 
                'isOpenInvite'=>!$isVerify,
                'SID'=>$session->sessionID,
            ));
        } else {
            $player = MPlayer::model()->findByPk($device->playerId);
            if ($player->ban==1) {
                throw new MException("账号已被封");
            }
            $device = MDevice::model()->findByAttributes(array('uid'=>$uid));
            $device->token = $token;
            $device->saveAttributes(array('token'));

            $player->login();

            $session = Yii::app()->session;
            $session['playerId'] = $device->playerId;
            $this->echoJsonData(array(
                'result'=>true, 
                'isOpenInvite'=>!$isVerify,
                'SID'=>$session->sessionID,
            ));
        }
    }

    public function actionRegisterApi($name, $inviterCode, $term=NULL, $os=NULL)
    {
        if (empty($name)) {
            throw new MException('注册信息不完整');
        }
        $session = Yii::app()->session;
        $session->setSessionID($_REQUEST['SID']);
        $session->open();
        $id = $session['id'];
        if (empty($id)) {
            $this->response->setError(102, '重新登录');//重新登录
            $this->response->render();
        }

        $device = MDevice::model()->findByPk($id);
        if (empty($device)) {
            throw new MException('未登录');
        }
        if (MPlayer::model()->isNameExist(trim($name))) {
            throw new MException('用户名已被注册');
        }
        /*
        $namelen = (strlen($name)+mb_strlen($name,"UTF8"))/2;
        if ($namelen>12) {
            throw new MException('用户名超过最大长度');
        }
         */
        $pattern = '/^[a-zA-Z0-9\x{30A0}-\x{30FF}\x{3040}-\x{309F}\x{4E00}-\x{9FBF}]+$/u';
        if (!preg_match($pattern, $name)) {
            throw new MException("用户名含有特殊字符");
        }

        if ($inviterCode != '') {
            if (!$inviterId = MPlayer::model()->getPlayerIdByCode(strtolower(trim($inviterCode)))) {
                throw new MException("邀请ID不存在");
            }
        }

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $player = $device->register(trim($name), empty($inviterId)?NULL:$inviterId, $term, $os);
            $transaction->commit();

            $player->login();
            $session['playerId'] = $device->playerId;
            $this->echoJsonData(array('result'=>true));
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function actionLogin($uid=null)
    {
        if(!YII_DEBUG){
            Yii::app()->end();
        }
        if(isset($uid)){
            $this->redirect(array('loginApi', 'uid'=>$uid, 'sig'=>$this->getSig($uid)));
        } else{
            $this->render('login');
        }
    }

    public function actionSetToken() {
        if (isset($_GET['uid']) && isset($_GET['token']) && isset($_GET['te']) 
            && ((isset($_GET['sig']) && $_GET['sig'] == Util::getSignification($_GET['uid'] . $_GET['token'] . $_GET['te'])) || !CHECK_SIG_FLAG)
        ) {
            MDevice::setToken($_GET['uid'], $_GET['token']);
        }
        else {
            throw new SException(Yii::t('View', 'param error'));
        }
    }

    public function actionSetDevice($device, $os, $version)
    {
        $session = Yii::app()->session;
        $session->open();
        $id = $session['id'];
        MDevice::setDevice($id, $device, $os, $version);
    }
}
