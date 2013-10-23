<?php

/** 
 * @file MLoginManager.php
 * @brief
 * @author Ji Shankai
 * @version 1.0
 * @date 2012-11-08
 */
class MLoginManager extends CActiveRecordBehavior
{
    private $_login;

    public function initLogin()
    {
        $login = new MLogin;
        $login->playerId = $this->owner->playerId;
        $login->createTime = $this->owner->createTime;
        $login->save();
    }

    public function getLogin()
    {
        if (isset($this->_login)) {
            return $this->_login;
        }
        return $this->_login = MLogin::model()->findByPk($this->owner->playerId);
    }

    public function login()
    {
        $this->owner->onLogin = array($this->owner, 'checkLoginRewards');
        $this->owner->onLogin = array($this->owner, 'checkByLogin');
        $this->owner->onLogin = array($this->owner, 'checkByDuration');
        $this->owner->onLogin = array($this->owner, 'updateLogin');
        $this->owner->onLogin = array($this->owner, 'summaryLogin');

        $this->owner->onLogin(new CEvent($this));
    }
}
