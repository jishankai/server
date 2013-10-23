<?php

class BattleController extends Controller
{
    private $_match;
    private $_start;
    private $_opponent;
    private $_cp;
    private $_cpAuto;
    private $_time;
    private $_battleId;
    private $_sPole; //self
    private $_oPole; //opponent

    private $_over;
    private $_result;
    private $_animation;

    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            'checkSig',
        );    
    }

   ``
}
