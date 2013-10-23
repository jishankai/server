<?php

class AccountUserSummaryCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: AccountUserSummary start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $time=time();
            $end=strtotime(date('Y-m-d',$time));//每日新记录结束时间点
            $start=$end-24*60*60;//开始统计时间
            Yii::app()->db->createCommand("
                insert ignore into
                admin_UserSummary(date, increase, register, total, createTime)
                select $start as date,
                (select count(*) from device where device.createTime>=$start and device.createTime<$end) as increase,
                (select count(*) from device join player on device.playerId=player.playerId where device.createTime>=$start and device.createTime<$end and (player.createTime-device.createTime)<86400) as register,
                (select count(*) from device where device.createTime<$end) as total,
                $time as createTime
                ")->execute();
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

