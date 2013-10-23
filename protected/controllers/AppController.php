<?php
class AppController extends Controller
{    
    public function filters()
    {
        return array(
            'getPlayerId',
        );    
    }

	public function actionItunesProductApi()
	{
        $props = Util::loadConfig('props');
        $player = MPlayer::model()->findByPk($this->playerId);
        $own = $player->getProps();

        foreach ($props as $propsId => $propsInfo) {
            if (array_key_exists('total', $propsInfo)) {
                unset($propsInfo['total']);
            }
            $propsInfo['own'] = $own[$propsId];
            $propsInfo['url'] = $this->createAbsoluteUrl('app/itunesPurchaseCallback');
        }
         
        $this->echoJsonData(
            array(
                'integral' => $player->integral,
                'goods' => $props,
            )
        );
	}
    
    public function actionItunesPurchaseCallback(){
        //method check
        if($_SERVER['REQUEST_METHOD'] != 'POST'){
            $this->echoJsonData(array(
                'flag' => '403',
                'title' => 'Error',
                'message' => 'Invalid Method!',
            ));
            return;
        }
        
        //param check$player = MPlayer::model()->findByPk($this->playerId);
        $tm = time();
        $va = new Validator();
        $va->check(array(
            'uid' => array('not_blank',array('length',1,64)),
            'tid' => array('not_blank',array('length',1,255)),
            'tm' => array('not_blank'),//,array('uint_range',$tm-86400,$tm+86400)),
            'sig' => array('not_blank'),
        ));
        if(!$va->success){
            $this->echoJsonData(array(
                'flag' => '403',
                'title' => 'Error',
                'message' => 'Invalid Params!',
            ));
            return;
        }
        
        //sig check
        $cfgPurchase = Util::loadConfig('ItunesPurchase');
        $sig = hash('sha256',$va->valid['uid'].$va->valid['tid'].$va->valid['tm'].$cfgPurchase['SigKey']);
        if($sig != $va->valid['sig']){
            $this->echoJsonData(array(
                'flag' => '403',
                'title' => 'Error',
                'message' => 'Invalid Signature!',
            ));
            return;
        }
        
        //data check
        //$receiptData = file_get_contents('php://input');
        $receiptData = $_REQUEST['data'];
        if(!$receiptData){
            $this->echoJsonData(array(
                'flag' => '403',
                'title' => 'Error',
                'message' => 'Invalid BodyData!',
            ));
            return;
        }
        
//        session_id($va->valid['uid']);
//        session_start();
//        if(!isset($_SESSION['sns_id'])){
//            $this->renderPartial('itunesPurchaseCallback',array(
//                'flag' => '403',
//                'title' => 'Error',
//                'message' => 'Invalid User!',
//            ));
//            return;
//        }
//        $sns_id = $_SESSION['sns_id'];
        $sns_id = $va->valid['uid'];
        
        $flag = 500;//unknown error
        $itunesPaymentTransaction = ItunesPaymentTransaction::model()->findByAttributes(array(
            'transaction_id' => $va->valid['tid'],
        ));
        if($itunesPaymentTransaction && $itunesPaymentTransaction->transaction_status==0){
            $flag = 2;//success(repeat commit)
        }else{
            $verifyContent = '';
            $verifyDir = Yii::app()->getRuntimePath().'/../data/itunesTransactionVerify/';
            $verifyFile = $verifyDir.$va->valid['tid'].'.itnsvfy';
            if(file_exists($verifyFile)){
                $verifyContent = file_get_contents($verifyFile);
            }else{
                $receiptVerifyUrl = $cfgPurchase['ReceiptVerifyUrl'];
                $verifyContent = Util::postRequest($receiptVerifyUrl,json_encode(array('receipt-data'=>$receiptData)));
            }
            if($verifyContent){
                $verifyResult = json_decode($verifyContent,true);
                if(isset($verifyResult['receipt'])){
                    $dba = ItunesPaymentTransaction::model()->getDbConnection();
                    
                    $transaction_id = $verifyResult['receipt']['transaction_id'];
                    $product_id = $verifyResult['receipt']['product_id'];
                    $quantity = $verifyResult['receipt']['quantity'];
                    if(isset($cfgPurchase['products'][$product_id])){
                        $productConf = $cfgPurchase['products'][$product_id];
                        $price = $productConf['price'];
                        $dollar = $productConf['dollar'];
                        $jpy = $productConf['jpy'];
                        $props = $productConf['props'];
                        $integral = $productConf['integral'] * $quantity;
                        if($verifyResult['status'] == 0){
                            if(!file_exists($verifyDir)){
                                @mkdir($verifyDir);
                            }
                            if(!file_exists($verifyFile)){
                                @file_put_contents($verifyFile,$verifyContent);
                            }
                            
                            $flag = 1;//success
                            $transaction = $dba->beginTransaction();
                            try {
                                $cmd = $dba->createCommand("insert into `ItunesPaymentTransaction` (`sns_id`,`transaction_id`,`transaction_status`,`product_id`,`price`,`dollar`,`jpy`,`quantity`,`props`,`integral`,`createTime`) 
                                values ('$sns_id','$transaction_id',0,'$product_id',$price,$dollar,$jpy,$quantity,'$props',$integral,unix_timestamp()) 
                                on duplicate key update `transaction_status`=0");
                                $affect_rows = $cmd->execute();
                                if($affect_rows > 0){
                                    $itunesPaymentTransaction = ItunesPaymentTransaction::model()->findByAttributes(array(
                                        'transaction_id' => $transaction_id,
                                    ));
                                    if($itunesPaymentTransaction){
                                        //events
                                        $itunesPaymentTransaction->onAfterSave = array(new Recharge(), 'record');
                                        $itunesPaymentTransaction->onAfterSave = array(new MProps(), 'rewardNewBuyer');

                                        if (isset($_REQUEST['uid'])) {
                                            $device = MDevice::model()->find('uid = :deviceId', array(':deviceId' => $_REQUEST['uid']));
                                            if (isset($device)) {
                                                $itunesPaymentTransaction->playerId = $device->playerId;
                                            }
                                            $itunesPaymentTransaction->save();
                                            
                                            //添加道具
                                            $props = explode('_', $props);
                                            $integral = $itunesPaymentTransaction->integral;
                                            MProps::createProps($device->playerId, $props[0], $props[1]*$quantity, PROPS_OPERATE_BUY);
                                            $player = MPlayer::model()->findByPk($device->playerId);
                                            $player->integral = $integral;
                                            $player->saveAttributes(array('integral'));

                                            $transaction->commit();
                                        }
                                    }
                                }
                            } catch(Exception $e) {
                                $flag = 501;
                                $transaction->rollback();
                            }
                        }else{
                            $flag = 102;//transaction not finish
                            $transaction_status = $verifyResult['status'];
                            $cmd = $dba->createCommand("insert ignore into `ItunesPaymentTransaction` (`sns_id`,`transaction_id`,`transaction_status`,`product_id`,`price`,`quantity`,`props`,`integral`,`createTime`) 
                            values ('$sns_id','$transaction_id',$transaction_status,'$product_id',$price,$quantity,'$props',$integral,unix_timestamp()");
                            $cmd->execute();
                        }
                    }else{
                        $flag = 101;//product not exist
                        $cmd = $dba->createCommand("insert ignore into `ItunesPaymentTransaction` (`sns_id`,`transaction_id`,`transaction_status`,`product_id`,`price`,`quantity`,`props`,`integral`,`createTime`) 
                        values ('$sns_id','$transaction_id',101,'$product_id',0,$quantity,NULL,0,unix_timestamp());");
                        $cmd->execute();
                    }
                }
            }
        }
        
        $this->echoJsonData(array(
            'flag' => $flag,
        ));
    }
}
?>
