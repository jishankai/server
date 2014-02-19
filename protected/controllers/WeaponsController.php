<?php

class WeaponsController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            //'checkSig',
        );      
    }

    public function actionBuyApi($weaponId)
    {
        $weapon = MWeapons::model()->findByAttributes(array('playerId'=>$this->playerId, 'weaponId'->$weaponId));
        if (isset($weapon)) {
            $weapon->level++;
            $weapon->saveAttributes(array('level'));
        } else {
            $weapon = new MWeapon;
            $weapon->playerId = $this->playerId;
            $weapon->weaponid = $weaponid;
            $weapon->level = 1;
            $weapon->createTime = now();
            $weapon->save();
        }

        $this->echoJsonData(array('result'=>true));
    }
}
