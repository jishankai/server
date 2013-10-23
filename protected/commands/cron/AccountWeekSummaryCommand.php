<?php

class AccountWeekSummaryCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: AccountWeekSummary start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $time=time();
            $day=strtotime(date('Y-m-d',$time));//每日新记录结束时间点
            $dayWeek=date('N',$day);//星期几1~7
            $day=$day-($dayWeek-1)*24*60*60;
            $dayFrom=$day-24*60*60*7;//开始统计时间
            $sql="insert into admin_WeekSummary(date,au,pu,rmb,dollar,jpy,createTime) 
                select $dayFrom,
                (select count(distinct(playerId)) from admin_LoginSummary where date>=$dayFrom and date<$day) as au,
                count(distinct(playerId)) as pu,
                sum(rmb) as rmb,
                sum(dollar) as dollar,
                sum(jpy) as jpy,
                $time
                from admin_Recharge where createTime>=$dayFrom and createTime<$day";

            $connection=Yii::app()->db;
            $command = $connection->createCommand($sql);
            $data = $command->execute();
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

