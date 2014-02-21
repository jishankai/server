<?php

class ArmsController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            //'checkSig',
        );      
    }

    public function actionBuyApi($armId)
    {
        $arm = MArms::model()->findByAttributes(array( 'playerId'=>$this->playerId, 'armId'->$armId));
        if (isset($arm)) {
            $arm->level++;
            $arm->saveAttributes(array('level'));
        } else {
            $arms = new MArms;
            $arms->playerId = $this->playerId;
            $arms->armId = $armId;
            $arms->level = 1;
            $arms->createTime = now();
            $arms->save();
        }

        $this->echoJsonData(array('result'=>true));
    }

    public function actionInfoApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);

        $this->echoJsonData(array(
            'isSuccess' = > true,
            'arms'=>$player->getArms()
        ));
    }
}
