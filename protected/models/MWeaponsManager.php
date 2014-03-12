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
    private $_equipedWeapons;

    public function getWeapons()
    {
        if (isset($this->_weapons)) {
            return $this->_weapons;
        }
        return $this->_weapons = MWeapons::model()->findByAttributes(array($this->owner->playerId));
    }

    public function initWeapons()
    {    
        $weapons = new MWeapons;
        $weapons->playerId = $this->owner->playerId;
        $weapons->weaponId = SCEPTER_FISH_ID;
        $weapons->level = 1;
        $weapons->createTime = $this->owner->createTime;
        $weapons->save();
    }

    public function getWeaponById($weaponId)
    {
        return MWeapons::model()->findByAttributes(array('playerId'=>$this->owner->playerId, 'weaponId'=>$weaponId));
    }

    public function getEquipedWeapons()
    {
        if (isset($this->_equipedWeapons)) {
            return $this->_equipedWeapons;
        }
        return $this->_equipedWeapons = MWeapons::model()->findByAttributes(array('playerId'=>$this->owner->playerId, 'isEquiped'=>1));
       
    }

    public function setWeaponEquiped($weaponId, $isEquiped)
    {
        $weapon = MWeapons::model()->findByAttributes(array('playerId'=>$this->owner->playerId, 'weaponId'=>$weaponId));
        if (isset($weapon) and $weapon->isEquiped!=$isEquiped) {
            $weapon->isEquiped = $isEquiped;
            $weapon->saveAttributes(array('isEquiped'));
        }
    }

    
}
