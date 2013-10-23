<?php

class CronSql
{
    public function cronPlayerSummary($start, $end)
    {
        $time=time();
        $sql="select $start as date,
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
            ";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read();
    }

    public function cronStatsSummary($start, $end)
    {
        $time=time();
        $sql="select $start as date, sum(playerId1=0 or playerId2=0) as practice, count(*) as total, sum(playerId1<>0 and playerId2<>0) as world, sum(reason=2 or reason=4) as flee, sum(reason=0 or reason=1) as regular, createTime from result where createTime>=$start and createTime<$end";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read();
    }

    public function cronUserSummary($start, $end)
    {
        $time=time();
        $sql="select $start as date,
            (select count(*) from device where device.createTime>=$start and device.createTime<$end) as increase,
            (select count(*) from device join player on device.playerId=player.playerId where device.createTime>=$start and device.createTime<$end and (player.createTime-device.createTime)<86400) as register,
            (select count(*) from device where device.createTime<$end) as total,
            $time as createTime";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read();
    }

    public function cronHotSales($start, $end)
    {
        $time=time();
        $sql="select $start as date,
            (select count(*) from admin_Recharge where product_id='ActionPoint_1' and createTime>=$start and createTime<$end) as cp_1,
            (select count(*) from admin_Recharge where product_id='ActionPoint_2' and createTime>=$start and createTime<$end) as cp_6,
            (select count(*) from admin_Recharge where product_id=".IAP_PRODUCT_CP12." and createTime>=$start and createTime<$end) as cp_12,
            (select count(*) from admin_Recharge where product_id='SightLine' and createTime>=$start and createTime<$end) as line,
            (select count(*) from admin_Recharge where product_id='StoneBroken' and createTime>=$start and createTime<$end) as stone,
            $time as createTime
            from admin_Recharge"; 
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read();
    }

    public function cronRechargeSummary($start, $end, $rate)
    {
        $time = time();
        $sql = "select date, week, month, dollar as searchDollar, dollar*$rate as myDollar, rmb as searchRMB, rmb*$rate as myRMB from admin_Recharge where date>=$start and date<$end group by date";
        $connection=Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read();
    }

    public function cronWeekSummary($start, $end)
    {
        $time = time();
        $sql = "select $start as date,
            (select count(distinct(playerId)) from admin_LoginSummary where date>=$start and date<$end) as au,
            count(distinct(playerId)) as pu,
            sum(rmb) as rmb,
            sum(dollar) as dollar,
            $time as createTime,
            '".date('Y-m-d H:i:s', $time)."' as updateTime
            from admin_Recharge where createTime>=$start and createTime<$end";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read(); 
    }

    public function cronMonthSummary($start, $end)
    {
        $time = time();
        $sql = "select $start as date,
            (select count(distinct(playerId)) from admin_LoginSummary where date>=$start and date<$end) as au,
            count(distinct(playerId)) as pu,
            sum(rmb) as rmb,
            sum(dollar) as dollar,
            $time as createTime,
            '".date('Y-m-d H:i:s', $time)."' as updateTime
            from admin_Recharge where createTime>=$start and createTime<$end";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $data = $command->query();
        return $data->read();  
    }
}
