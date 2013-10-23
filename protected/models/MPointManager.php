<?php

/** 
* @file MPointManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MPointManager extends CActiveRecordBehavior
{
    private $_point;

    public function initPoint()
    {
        $point = new MPoint;
        $point->playerId = $this->owner->playerId;
        $point->point = AP_VALUE;
        $point->createTime = $this->owner->createTime;
        $point->save();
    }

    public function getPoint()
    {
        if (isset($this->_point)) {
            return $this->_point;
        }
        return $this->_point = MPoint::model()->findByPk($this->owner->playerId);
    }
}
