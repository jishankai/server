<?php

/** 
* @file MFieldManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MFieldManager extends CActiveRecordBehavior
{
    private $_field;

    public function initField()
    {
        $field = new MField;
        $field->playerId = $this->owner->playerId;
        $field->createTime = $this->owner->createTime;
        $field->save();
    }

    public function getField()
    {
        if (isset($this->_field)) {
            return $this->_field;
        }
        
        return $this->_field = MField::model()->findByPk($this->owner->playerId);
    }
}
