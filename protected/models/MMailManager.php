<?php

/** 
* @file MMailManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MMailManager extends CActiveRecordBehavior
{
    private $_mail;

    public function getUnReceivedMail()
    {
        if (isset($this->_mail)) {
            return $this->_mail;
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'isReceived = :isReceived';
        $criteria->params = array(':isReceived' => 0);
        $criteria->order = 'createTime DESC';
        $this->_mail = MMail::model()->findAllbyAttributes(array('playerId'=>$this->owner->playerId), $criteria);
        return $this->_mail;
    }
}
