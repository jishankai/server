<?php

class BattleController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            //'checkSig',
        );    
    }

    public function actionWinApi($level, $stars) {
        $player = MPlayer::model()->findByPk($this->playerId);
        $process = $player->getProcess();
        $player->updateProcessStars($level, 3);
        if ($level==count($process)) {
            $player->initProcessByLevel(++$level);
            $process = $player->getProcess();
        }
        $this->echoJsonData(array(
            //'playerId' => (int)$player->playerId,
            //'point' => $player->getPoint()->getValue(),
            //'remainTime' => $player->getPoint()->getRemainTime(),
            //'interval' => AP_CHANGEINTERVAL,
            //'changeMax' => AP_CHANGEMAX,
            'process' => array(
                'count' => count($process),
                'levels' => $process,
            ),
        ));
    }
}
