<?php

class NewsController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'getPlayerId',
            'checkSig',
        );      
    }

    function actionMd5Api($lang)
    {
        $this->echoJsonData(array(
            'md5' => News::model()->getMd5($lang),
        ));
    }

    function actionListMd5Api($lang)
    {
        $this->echoJsonData(News::model()->getListMd5($lang));
    }

    function actionUpdateApi($ids, $lang)
    {
        if ($ids=='') {
            $this->echoJsonData(array());
        } else {
            $ids = explode('_', $ids);
            $string = implode(',', $ids);
            $data = Yii::app()->db->createCommand('SELECT id, title_'.$lang.', content_'.$lang.', isTop, startTime, endTime FROM admin_News WHERE id IN ('.$string.')')->queryAll();

            $this->echoJsonData($data);
        }
    }

    function actionReadApi($id, $lang)
    {
        $tableName = 'playerNews_'.ceil($this->playerId/PLAYERNEWS_DEVIDE);
        $isExist = Yii::app()->db->createCommand('SELECT id FROM '.$tableName.' WHERE playerId=:playerId AND newsId=:newsId')->bindValues(array(
            ':playerId' => $this->playerId,
            ':newsId' => $id,
        ))->queryScalar();
        if (empty($isExist)) {
            Yii::app()->db->createCommand('INSERT INTO '.$tableName.'(playerId, newsId, createTime) VALUES(:playerId, :newsId, :createTime)')->bindValues(array(
                ':playerId' => $this->playerId,
                ':newsId' => $id,
                ':createTime' => time(),
            ))->execute();
        }

        $data = Yii::app()->db->createCommand('SELECT id, title_'.$lang.', content_'.$lang.', isTop, startTime, endTime FROM admin_News WHERE id=:id')->bindValue(':id', $id)->queryRow();

        $this->echoJsonData(array(
            //'content' => $data['content_'.$lang],
            'md5' => md5(implode('_', $data)),
        ));
    }

    function actionIsReadApi()
    {
        $tableName = 'playerNews_'.ceil($this->playerId/PLAYERNEWS_DEVIDE);
        $ids = Yii::app()->db->createCommand('SELECT newsId FROM '.$tableName.' WHERE playerId=:playerId')->bindValue(':playerId', $this->playerId)->queryColumn();

        $this->echoJsonData(array(
            'ids' => $ids,
        ));
    }

    function actionNumApi()
    {
        $time = time();
        $ids = Yii::app()->db->createCommand("SELECT id FROM admin_News WHERE startTime<=$time AND endTime>$time")->queryColumn();
        $tableName = 'playerNews_'.ceil($this->playerId/PLAYERNEWS_DEVIDE);
        $readIds = Yii::app()->db->createCommand('SELECT newsId FROM '.$tableName.' WHERE playerId=:playerId')->bindValue(':playerId', $this->playerId)->queryColumn();

        $this->echoJsonData(array('num'=>count(array_diff($ids, $readIds))));
    }
}
