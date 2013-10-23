<?php

class ShopController extends Controller
{   
    public function filters()
    {
        return array(
            'checkUpdate',
            //'getPlayerId',
            'checkSig',
        );    
    }

	public function actionShelfApi()
	{
        $props = Util::loadConfig('props');
        $player = MPlayer::model()->findByPk($this->playerId);
        $own = $player->getProps();

        foreach ($props as $propsId => $propsInfo) {
            if (array_key_exists('total', $propsInfo)) {
                unset($propsInfo['total']);
            }
            $propsInfo['own'] = $own[$propsId];
            $props[$propsId] = $propsInfo;
        }
         
        $this->echoJsonData(
            array(
                'integral' => $player->integral,
                'goods' => $props,
            )
        );
	}

    public function actionExchangeApi($propsId, $quantity)
    {
        $props = Util::loadConfig('props');
        $goods = $props[$propsId];

        $player = MPlayer::model()->findByPk($this->playerId);
        if ($player->integral >= $goods['integral']*$quantity) {
            $player->integral -= $goods['integral']*$quantity;
            $player->saveAttributes(array('integral'));
            MProps::createProps($this->playerId, $propsId, $quantity, PROPS_OPERATE_EXCHANGE);

            $this->echoJsonData(array(
                'result' => true,
            ));
        } else {
            throw new MException('积分不足');
        }
    }

    public function actionIapApi()
    {
        $iap = Util::loadConfig('iap');
        $this->echoJsonData(
            array(
                'iap' => $iap,
            )
        );
    }
}
