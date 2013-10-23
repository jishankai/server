<?php

class AccountPlayerSummaryCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: AccountPlayerSummary start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $time=time();
            $end=strtotime(date('Y-m-d',$time));//每日新记录结束时间点
            $start=$end-24*60*60;//开始统计时间
            $week = date('W', $start);
            $month = date('n', $start);

            Yii::app()->db->createCommand("
                insert ignore into
                admin_PlayerSummary(date, week, month, dollar, rmb, dnu, dau, ydau, total, vip_today, vip_increase, vip_total, createTime)
                select $start as date,
                $week as week,
                $month as month,
                (select sum(dollar) from ItunesPaymentTransaction where ItunesPaymentTransaction.createTime >= $start and ItunesPaymentTransaction.createTime < $end) as dollar, 
                (select sum(price) from ItunesPaymentTransaction where ItunesPaymentTransaction.createTime >= $start and ItunesPaymentTransaction.createTime < $end) as rmb,
                (select count(*) from player where player.createTime>=$start and player.createTime<$end) as dnu,
                (select count(*) from login where loginTime>=$start and loginTime<$end) as dau,
                (select count(*) from login where loginTime>=$start and loginTime<$end and duration>1) as ydau,
                (select count(*) from player where player.createTime<$end) as total,
                (select count(distinct(playerId)) from ItunesPaymentTransaction where ItunesPaymentTransaction.createTime>=$start and ItunesPaymentTransaction.createTime<$end) as vip_today,
                ((select count(distinct(playerId)) from ItunesPaymentTransaction where ItunesPaymentTransaction.createTime<$end) - (select count(distinct(playerId)) from ItunesPaymentTransaction where ItunesPaymentTransaction.createTime<$start)) as vip_increase,
                (select count(distinct(playerId)) from ItunesPaymentTransaction where ItunesPaymentTransaction.createTime<$end) as vip_total,
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

