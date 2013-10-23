<?php

class CalculateRankCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: CalculateRank start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            //clear
            Yii::app()->db->createCommand('DELETE FROM cron_Rank')->execute();

            Yii::app()->db->createCommand('
                INSERT INTO cron_Rank(playerId, name, `character`, medalList, score, createTime) SELECT * FROM (SELECT player.playerId, player.name, player.character, player.medalList, battle.score, '.time().' FROM player JOIN battle ON player.playerId = battle.playerId ORDER BY battle.score DESC LIMIT 500) AS tb  
                ')->execute();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    public function run($args)
    {
        if (isset($args[0]) && $args[0]=='start') {
            $this->start();
        } else {
            return $this->usage();
        }

    }
}

