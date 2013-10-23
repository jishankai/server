<?php

class AccountMonthSummaryCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: AccountMonthSummary start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $time=time();
            $month = date('m');
            $year = date('Y');
            $last_month = date('m') - 1;
            $day=mktime(0, 0, 0, $month, 1, $year);
            if($month == 1)
            {
                $last_month = 12;
                $year = $year - 1;
            }
            $dayFrom=mktime(0, 0, 0, $last_month, 1, $year);
            $sql="insert into admin_MonthSummary(date,au,pu,rmb,dollar,jpy,createTime) 
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

