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

    public function actionStartApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $point = $player->getPoint();

        $point->check();
        
        $point->sub();
        $this->echoJsonData(array(
            'result' => true,
            'cp' => $point->getValue();
            'cpTime' => $point->getRemainTime();
        ));
    }

    public function actionWinApi($level, $stars, $coin=0, $equipId=NULL)
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $player->coin+=$coin;
        $player->saveAttributes(array('coin'));
        $process = $player->getProcess();
        $player->updateProcessStars($level,$stars);
        if ($level==count($process)) {
            $player->initProcessByLevel(++$level);
            $process = $player->getProcess();
        }
        $this->echoJsonData(array(
            'playerId' => (int)$player->playerId,
            'coin'=>$player->coin,
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
