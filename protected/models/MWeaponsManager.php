<?php

/** 
* @file MWeaponsManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MWeaponsManager extends CActiveRecordBehavior
{
    private $_weapons;
    
    public function getWeapons()
    {
        if (isset($this->_weapons)) {
            return $this->_weapons;
        }
        return $this->_weapons = MWeapons::model()->findByPk($this->owner->playerId);
    }

    public function initWeapons()
    {    
        $weapons = new MWeapons;
        $weapons->playerId = $this->owner->playerId;
        $weapons->weaponId = 1;
        $weapons->level = 1;
        $weapons->createTime = $this->owner->createTime;
        $weapons->save();
    }

}
