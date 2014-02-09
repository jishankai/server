<?php

class PlayerController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            //'checkSig',
        );      
    }

    public function actionPlayerApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $process = $player->getProcess();
        $this->echoJsonData(array(
            'playerId' => (int)$player->playerId,
            'playerName' => $player->name,
            'coin' => $player->coin,
            'jewel' => $player->jewel,
            'point' => $player->getPoint()->getValue(),
            //'remainTime' => $player->getPoint()->getRemainTime(),
            //'interval' => AP_CHANGEINTERVAL,
            //'changeMax' => AP_CHANGEMAX,
            'combats' => (int)$player->combats,
            'stars' => (int)$player->stars,
            's1' => (int)$player->getS1()->level,
            's2' => (int)$player->getS2()->level,
            's3' => (int)$player->getS3()->level,
            's4' => (int)$player->getS4()->level,
            's5' => (int)$player->getS5()->level,
            's6' => (int)$player->getS6()->level,
            's7' => (int)$player->getS7()->level,
            's8' => (int)$player->getS8()->level,
            's9' => (int)$player->getS9()->level,
            'process' => array(
                'count' => count($process),
                'levels' => $process,
            ),
        ));
    }
    
    public function actionInfoApi($playerId)
    {
        $player = MPlayer::model()->findByPk($playerId);
        $this->echoJsonData(array(
            'playerId' => $player->playerId,
        ));
    }

    public function actionSetMedalListApi($medalString)
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $player->setMedalList($medalString);
        $this->echoJsonData(array(
            'result' => true,
        ));
    }

    public function actionWorldRankApi($page)
    {
        $left = 50*($page-1);
        $right = 50*$page;
        $list = Yii::app()->db->createCommand('SELECT * FROM admin_Rank LIMIT '.$left.', '.$right)->queryAll();
        $this->echoJsonData($list);
    }

    public function actionInviteCountApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $this->echoJsonData(array(
            'count' => $player->inviteCount,
        ));
    }

}
