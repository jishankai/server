<?php

/** 
* @file MAccessoriesManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MAccessoriesManager extends CActiveRecordBehavior
{
    private $_accessories;

    public function getAccessories()
    {
        if (isset($this->_accessories)) {
            return $this->_accessories;
        }
        return $this->_accessories = MAccessories::model()->findByPk($this->owner->playerId);
    }
}
