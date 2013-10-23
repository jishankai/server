<?php

class PropsController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            'checkSig',
        );      
    }

	public function actionCpApi()
	{
        try {
            $total = MProps::useProps($this->playerId, PROPS_CP_ID, 1);
            $point = MPoint::model()->findByPk($this->playerId);
            $point->reMax();
            $this->echoJsonData(array(
                'cp' => $point->getValue(),
                'cpAuto' => $point->getAutoMax(),
                'time' => $point->getRemainTime(),
                'propsId' => PROPS_CP_ID,
                'total' => $total,
            ));
        } catch (Exception $e) {
            throw new MException('行动力不足');
        }
	}

    public function actionPropsApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);
        $this->echoJsonData(array(
            'propsInfo' => $player->getProps(),
        ));
    }
}
