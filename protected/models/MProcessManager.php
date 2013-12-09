<?php

/** 
* @file MProcessManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MProcessManager extends CActiveRecordBehavior
{
    private $_process;

    public function initProcess()
    {
        $process = new MProcess;
        $process->playerId = $this->owner->playerId;
        $process->level = 1;
        $process->stars = 0;
        $process->createTime = $this->owner->createTime;
        $process->save();
    }
    public function getProcess()
    {
        if (isset($this->_process)) {
            return $this->_process;
        }
        $this->_process = MProcess::model()->findAllbyAttributes(array('playerId'=>$this->owner->playerId));
        return $this->_process;
    }
}
