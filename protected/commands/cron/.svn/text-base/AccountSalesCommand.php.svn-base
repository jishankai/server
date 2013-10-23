<?php

class AccountSalesCommand extends CConsoleCommand
{
    private function usage()
    {
        echo "Usage: AccountSales start\n"; 
    }

    private function start()
    {
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $time=time();
            $end=strtotime(date('Y-m-d',$time));//每日新记录结束时间点
            $start=$end-24*60*60;//开始统计时间
            $sql="insert ignore into
                admin_Sales(date, cp_1, cp_6, cp_12, line, stone, createTime)
                select $start,
                (select count(*) from admin_Recharge where product_id='ActionPoint_1' and createTime>=$start and createTime<$end),
                (select count(*) from admin_Recharge where product_id='ActionPoint_2' and createTime>=$start and createTime<$end),
                (select count(*) from admin_Recharge where product_id=".IAP_PRODUCT_CP12." and createTime>=$start and createTime<$end),
                (select count(*) from admin_Recharge where product_id='SightLine' and createTime>=$start and createTime<$end),
                (select count(*) from admin_Recharge where product_id='StoneBroken' and createTime>=$start and createTime<$end),
                $time
                from admin_Recharge";
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

