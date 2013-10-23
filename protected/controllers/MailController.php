<?php

class MailController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            'checkSig',
        );    
    }

    public function actionMailApi()
    {
        $player = MPlayer::model()->findByPk($this->playerId);

        $info = array();
        $mails = $player->getUnReceivedMail();
        $i = 1;
        foreach ($mails as $mail) {
            $gift = explode('_', $mail->gift);
            $info[$i++] = array(
                'mailId' => $mail->id,
                'from' => $mail->from,
                'desc' => $mail->desc,
                'propsId' => $gift[0],
                'propsNum' => $gift[1],
                'createTime' => $mail->createTime,
            );
        }
        $this->echoJsonData($info);
    }

    public function actionNumApi()
    {
        $num = Yii::app()->db->createCommand('SELECT COUNT(*) FROM mail WHERE playerId=:playerId AND isReceived=0')->bindValue(':playerId', $this->playerId)->queryScalar();
        if ($num == FALSE) {
            $num = 0;
        }
        $this->echoJsonData(array('num' => $num));
    }

    public function actionReceiveApi($mailId)
    {
        $mail = MMail::model()->findByPk($mailId);

        $transaction = Yii::app()->db->beginTransaction();
        try {
            $gift = explode('_', $mail->gift);
            $isReceived = MProps::createProps($this->playerId, $gift[0], $gift[1], PROPS_OPERATE_MAIL);

            if ($isReceived) {
                $mail->isReceived = $isReceived;
                $mail->receiveTime = time();
                $mail->saveAttributes(array('isReceived', 'receiveTime'));
            }
            $transaction->commit();
            $player = MPlayer::model()->findByPk($this->playerId);
            $this->echoJsonData(array(
                'isReceived' => true,
                'props' => $player->getProps(),
            ));
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function actionReceiveAllApi()
    {
        $mails = MMail::model()->findAllByAttributes(array('playerId'=>$this->playerId, 'isReceived'=>MAIL_NOTRECEIVED)); 

        $transaction = Yii::app()->db->beginTransaction();
        try {
            foreach ($mails as $mail) {
                $gift = explode('_', $mail->gift);
                $isReceived = MProps::createProps($this->playerId, $gift[0], $gift[1], PROPS_OPERATE_MAIL);

                if ($isReceived) {
                    $mail->isReceived = $isReceived;
                    $mail->receiveTime = time();
                    $mail->saveAttributes(array('isReceived', 'receiveTime'));
                }
            }
            $transaction->commit();
            $player = MPlayer::model()->findByPk($this->playerId);
            $this->echoJsonData(array(
                'isReceived' => true,
                'props' => $player->getProps(),
            ));
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }
}
