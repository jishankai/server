<?php

class PlayerController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            'checkSig',
        );      
    }

    public function actionPlayerApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $this->echoJsonData(array(
            'playerId' => $player->playerId,
            'playerChar' => $player->character,
            'playerName' => $player->name,
            'rank' => $player->getBattle()->rank, 
            'score' => $player->getBattle()->score,
            'win' => $player->getBattle()->win,
            'draw' => $player->getBattle()->draw,
            'lose' => $player->getBattle()->lose,
            'conWin' => $player->getBattle()->conWin,
            'conWinMax' => $player->getBattle()->conWinMax,
            'conLose' => $player->getBattle()->conLose,
            'conLoseMax' => $player->getBattle()->conLoseMax,
            'aveatk' => $player->getStats()->aveatk,
            'maxatk' => $player->getStats()->maxatk,
            'avedef' => $player->getStats()->avedef,
            'maxdef' => $player->getStats()->maxdef,
            'avecombo' => $player->getStats()->avecombo,
            'maxcombo' => $player->getStats()->maxcombo,	
            'point' => $player->getPoint()->getValue(),
            'remainTime' => $player->getPoint()->getRemainTime(),
            'interval' => AP_CHANGEINTERVAL,
            'changeMax' => AP_CHANGEMAX,
            'propInfo' => $player->getProps(),			
            'medalInfo' => $player->getMedal(),
            'medalList' => $player->getMedalList(),
            'inviteCode' => $player->inviteCode,
            'totalInvite' => $player->inviteCount,
        ));
    }
    
    public function actionInfoApi($playerId)
    {
        $player = MPlayer::model()->findByPk($playerId);
        $this->echoJsonData(array(
            'playerId' => $player->playerId,
            'playerChar' => $player->character,
            'playerName' => $player->name,
            'rank' => $player->getBattle()->rank, 
            'score' => $player->getBattle()->score,
            'win' => $player->getBattle()->win,
            'draw' => $player->getBattle()->draw,
            'lose' => $player->getBattle()->lose,
            'conWin' => $player->getBattle()->conWin,
            'conWinMax' => $player->getBattle()->conWinMax,
            'conLose' => $player->getBattle()->conLose,
            'conLoseMax' => $player->getBattle()->conLoseMax,
            'aveatk' => $player->getStats()->aveatk,
            'maxatk' => $player->getStats()->maxatk,
            'avedef' => $player->getStats()->avedef,
            'maxdef' => $player->getStats()->maxdef,
            'avecombo' => $player->getStats()->avecombo,
            'maxcombo' => $player->getStats()->maxcombo,	
            'point' => $player->getPoint()->getValue(),
            'remainTime' => $player->getPoint()->getRemainTime(),
            'propInfo' => $player->getProps(),			
            'medalInfo' => $player->getMedal(),
            'medalList' => $player->getMedalList(),
            'inviteCode' => $player->inviteCode,
            'totalInvite' => $player->inviteCount,
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

    //test
    public function actionCpApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $this->echoJsonData(array(
            'playerId' => $player->playerId,
            'point' => $player->getPoint()->getValue(),
            'remainTime' => $player->getPoint()->getRemainTime(),
        ));
    }
}
