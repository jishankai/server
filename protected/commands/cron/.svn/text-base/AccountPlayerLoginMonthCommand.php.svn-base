<?php

class AccountPlayerLoginMonthCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: AccountPlayerLoginMonth start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $time = time();
            $day = strtotime(date('Y-m-d',$time));//每日新记录结束时间点
            $dayFrom = $day-24*60*60;//开始统计时间
            $month = strtotime(date('Y-m',$dayFrom));
            $sql = "replace into admin_PlayerLoginMonth(playerId,loginMonth,loginDetail,createTime)
                select admin_LoginSummary.playerId,admin_LoginSummary.month,
                POW(2,DAYOFMONTH(from_unixtime(admin_LoginSummary.date))-1)|ifnull(loginDetail ,0), 
                $time  
                from admin_LoginSummary left join  (select * from admin_PlayerLoginMonth 
                where  admin_PlayerLoginMonth.loginMonth=$month) as admin_PlayerLoginMonth
                on admin_LoginSummary.playerId=admin_PlayerLoginMonth.playerId 
                where admin_LoginSummary.date=$dayFrom";

            Yii::app()->db->createCommand($sql)->execute();

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

