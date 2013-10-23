<?php

class SalesController extends Controller
{
    protected $_lastWeekSummary;
    protected $_lastMonthSummary;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules()
    {
        return array(
        );
    }

    public function actionIndex()
    {
        $startTime = strtotime(date("Y-m"));//查询默认开始时间,本月第一天
        $endTime = strtotime(date("Y-m-d"));//查询默认结束时间,当前日零时
        $money = 0;//显示货币,当为美元：0,人民币：1
        $rate = 0.7;
        $todayStart = strtotime(date("Y-m-d"));
        $todayEnd = $todayStart + 86400;

        if(isset($_GET['search'])){
            if(!empty($_GET['startTime']) && !empty($_GET['endTime'])){
                $startTime = strtotime($_GET['startTime']);
                $endTime = strtotime($_GET['endTime']);
                $money = $_GET['money'];
                $rate = $_GET['rate'];
            }
        }

        $sqlSearch = "select date, week, month, dollar as searchDollar, dollar*$rate as myDollar, rmb as searchRMB, rmb*$rate as myRMB ";
        $sqlSearch .= 'from admin_PlayerSummary ';
        $sqlSearch .= 'where date >= '.$startTime.' and date <= '.$endTime;

        $search = Yii::app()->db->createCommand($sqlSearch)->queryAll();

        if($startTime <= $todayStart && $endTime >= $todayStart){
            $cron = new CronSql();
            $todaySummarys = $cron->cronRechargeSummary($todayStart, $todayEnd, $rate);
            $count = count($search);
            if (empty($todaySummarys)) {
                $search[$count]['date'] = $todayStart;
                $search[$count]['week'] = date('W', $todayStart);
                $search[$count]['month'] = date('n', $todayStart);
                $search[$count]['searchDollar'] = 0;
                $search[$count]['myDollar'] = 0;
                $search[$count]['searchRMB'] = 0;
                $search[$count]['myRMB'] = 0;
            } else {
                $search[$count]['date'] = $todaySummarys['date'];
                $search[$count]['week'] = $todaySummarys['week'];
                $search[$count]['month'] = $todaySummarys['month'];
                $search[$count]['searchDollar'] = $todaySummarys['searchDollar'];
                $search[$count]['myDollar'] = $todaySummarys['myDollar'];
                $search[$count]['searchRMB'] = $todaySummarys['searchRMB'];
                $search[$count]['myRMB'] = $todaySummarys['myRMB'];
            }
        }


        $weekSummaryUS = array();
        $weekSummaryRMB = array();
        $monthSummaryUS = array();
        $monthSummaryRMB = array();
        $weekMyUS = array();
        $weekMyRMB = array();
        $monthMyUS = array();
        $monthMyRMB = array();

        foreach ($search as $data) {
            $week = $data['week'];
            $month = $data['month'];

            $weekSummaryUS[$week] = (isset($weekSummaryUS[$week]) ? $weekSummaryUS[$week]+$data['searchDollar'] : $data['searchDollar']);
            $weekSummaryRMB[$week] = (isset($weekSummaryRMB[$week]) ? $weekSummaryRMB[$week]+$data['searchRMB'] : $data['searchRMB']);
            $monthSummaryUS[$month] = (isset($monthSummaryUS[$month]) ? $monthSummaryUS[$month]+$data['searchDollar'] : $data['searchDollar']);
            $monthSummaryRMB[$month] = (isset($monthSummaryRMB[$month]) ? $monthSummaryRMB[$month]+$data['searchRMB'] : $data['searchRMB']);

            $weekMyUS[$week] = (isset($weekMyUS[$week]) ? $weekMyUS[$week]+$data['myDollar'] : $data['myDollar']);
            $weekMyRMB[$week] = (isset($weekMyRMB[$week]) ? $weekMyRMB[$week]+$data['myRMB'] : $data['myRMB']);
            $monthMyUS[$month] = (isset($monthMyUS[$month]) ? $monthMyUS[$month]+$data['myDollar'] : $data['myDollar']);
            $monthMyRMB[$month] = (isset($monthMyRMB[$month]) ? $monthMyRMB[$month]+$data['myRMB'] : $data['myRMB']);
        }
        foreach ($search as $key=>$data) {
            $week = $data['week'];
            $month = $data['month'];

            $search[$key]['weekSummaryUS'] = $weekSummaryUS[$week];
            $search[$key]['weekSummaryRMB'] = $weekSummaryRMB[$week];
            $search[$key]['monthSummaryUS'] = $monthSummaryUS[$month];
            $search[$key]['monthSummaryRMB'] = $monthSummaryRMB[$month];

            $search[$key]['weekMyUS'] = $weekMyUS[$week];
            $search[$key]['weekMyRMB'] = $weekMyRMB[$week];
            $search[$key]['monthMyUS'] = $monthMyUS[$month];
            $search[$key]['monthMyRMB'] = $monthMyRMB[$month];
        }

        $sum = Yii::app()->db->createCommand("select sum(dollar) as dollar, sum(rmb) as rmb, sum(dollar)*$rate as myDollar, sum(rmb)*$rate as myRMB from admin_Recharge where date>=$startTime and date<$endTime")->queryRow();

        $result = Recharge::model()->array_sort($search, 'date', 'asc');

        $dataProvider = new CArrayDataProvider($result, array(
            'keyField' => 'date',
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));

        $this->render('index', compact('dataProvider', 'startTime', 'endTime', 'money', 'sum'));
    }

    public function actionPopular()
    {
        $startTime = strtotime(date('Y-m'));//查询默认开始时间,本月第一天
        $endTime = strtotime(date("Y-m-d"));//查询默认结束时间,当前日零时
        $todayStart = strtotime(date("Y-m-d"));
        $todayEnd = $todayStart + 86400;
        $type = 0; //售出or使用
        if(isset($_GET['search'])){
            if(!empty($_GET['startTime']) && !empty($_GET['endTime'])){
                $startTime = strtotime($_GET['startTime']);
                $endTime = strtotime($_GET['endTime']);
                //$type = $_GET['type'];
            }
        }

        if ($type) {
            $sql = 'select * ';
            $sql .= 'from admin_ProductUse ';
            $sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
            $sql .= 'order by date';
            $summary = Yii::app()->db->createCommand($sql)->queryAll();

            $sum = Yii::app()->db->createCommand("select '总计' as date, sum(cp_1) as cp_1, sum(cp_6) as cp_6, sum(cp_12) as cp_12, sum(line) as line, sum(stone) as stone from admin_ProductUse where createTime>=$startTime and createTime<$endTime")->queryRow();

            $cron = new CronSql();
            $todaySummarys = $cron->cronProductUse($todayStart, $todayEnd);
        } else {
            $sql = 'select * ';
            $sql .= 'from admin_Sales ';
            $sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
            $sql .= 'order by date';
            $summary = Yii::app()->db->createCommand($sql)->queryAll();

            $sum = Yii::app()->db->createCommand("select '总计' as date, sum(cp_1) as cp_1, sum(cp_6) as cp_6, sum(cp_12) as cp_12, sum(line) as line, sum(stone) as stone from admin_Sales where createTime>=$startTime and createTime<$endTime")->queryRow();

            $cron = new CronSql();
            $todaySummarys = $cron->cronHotSales($todayStart, $todayEnd);
        }

        //查询时间是否包括今日
        if($startTime <= $todayStart && $endTime >= $todayStart){
            $count = count($summary);
            $summary[$count]['date'] = $todaySummarys['date'];
            $summary[$count]['cp_1'] = $todaySummarys['cp_1'];
            $summary[$count]['cp_6'] = $todaySummarys['cp_6'];
            $summary[$count]['cp_12'] = $todaySummarys['cp_12'];
            $summary[$count]['line'] = $todaySummarys['line'];
            $summary[$count]['stone'] = $todaySummarys['stone'];
            $summary[$count]['createTime'] = $todaySummarys['createTime'];
            $summary[$count]['updateTime'] = date('Y-m-d H:i:s');

            $sum['cp_1'] += $todaySummarys['cp_1'];
            $sum['cp_6'] += $todaySummarys['cp_6'];
            $sum['cp_12'] += $todaySummarys['cp_12'];
            $sum['line'] += $todaySummarys['line'];
            $sum['stone'] += $todaySummarys['stone'];
        }

        $temp = array();
        foreach($summary as $key => $value){
            $summary[$key]['key'] = $key;
            $summary[$key]['pre'] = $temp;
            $temp = $value;
        }

        $dataProvider = new CArrayDataProvider($summary, array(
            'keyField' => 'date',
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
        $this->render('popular', compact('startTime', 'endTime', 'dataProvider', 'summary', 'sum', 'type'));
    }

    public function actionAnalysis()
    {
        $mod = isset($_GET['mod']) && $_GET['mod'] == 'week'?'week':'month';
        if($mod == 'month'){
            $start = strtotime(date('Y-m', time()));
            $end = time();
            $sql = 'select * ';
            $sql .= 'from admin_MonthSummary';
            $summary = Yii::app()->db->createCommand($sql)->queryAll();
            $cron = new CronSql();
            $lastData = $cron->cronMonthSummary($start, $end);
            $data = array_merge($summary, array($lastData));
            $temp = array();
            foreach($data as $key => $value){
                $data[$key]['key'] = $key;
                $data[$key]['pre'] = $temp;
                $temp = $value;
            }
            $dataProvider = new CArrayDataProvider($data, array(
                'keyField' => 'date',
                'pagination' => array(
                    'pageSize' => 100,
                ),
            ));
        }
        if($mod == 'week'){
            $weekTime = Recharge::model()->weekTime();
            $start = $weekTime['weekStartTime'];
            $end = time();
            $sql = 'select * ';
            $sql .= 'from admin_WeekSummary';
            $summary = Yii::app()->db->createCommand($sql)->queryAll();
            $cron = new CronSql();
            $lastData = $cron->cronWeekSummary($start, $end);
            $data = array_merge($summary, array($lastData));
            $temp = array();
            foreach($data as $key => $value){
                $data[$key]['key'] = $key;
                $data[$key]['pre'] = $temp;
                $temp = $value;
            }
            $dataProvider = new CArrayDataProvider($data, array(
                'keyField' => 'date',
                'pagination' => array(
                    'pageSize' => 100,
                ),
            ));
        }

        $this->render('analysis', compact('dataProvider'));
    }

    public function actionDetail()
    {
        $startTime = strtotime(date("Y-m"));//查询默认开始时间,本月第一天
        $endTime = strtotime(date("Y-m-d"));//查询默认结束时间,当前日零时
        $money = 0;//显示货币,当为美元：0,人民币：1

        if(isset($_GET['search'])){
            if(!empty($_GET['startTime']) && !empty($_GET['endTime'])){
                $startTime = strtotime($_GET['startTime']);
                $endTime = strtotime($_GET['endTime']);
                $money = $_GET['money'];
            }
        }

        if ($money) {
            $sql = 'select r.createTime as time, p.name as name, rmb as money, product_id as product ';
            $sql .= 'from admin_Recharge r join player p on r.playerId=p.playerId ';
            $sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
            $sql .= 'order by date';
            $summary = Yii::app()->db->createCommand($sql)->queryAll();
        } else {
            $sql = 'select r.createTime as time, p.name as name, dollar as money, product_id as product ';
            $sql .= 'from admin_Recharge r join player p on r.playerId=p.playerId ';
            $sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
            $sql .= 'order by date';
            $summary = Yii::app()->db->createCommand($sql)->queryAll();
        }

        $dataProvider = new CArrayDataProvider($summary, array(
            'keyField' => 'time',
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));

        $this->render('detail', compact('dataProvider', 'startTime', 'endTime', 'money'));
    }

    protected function gridWeekSummary($weekSummary)
    {

        if ($this->_lastWeekSummary != $weekSummary) {
            return $this->_lastWeekSummary = $weekSummary;
        } else {
            return NULL;
        }
    }

    protected function gridMonthSummary($monthSummary)
    {
        if ($this->_lastMonthSummary != $monthSummary) {
            return $this->_lastMonthSummary = $monthSummary;
        } else {
            return NULL;
        }
    }

    public static function getProductName($productId)
    {
        $productName = NULL;
        switch ($productId) {
        case 'ActionPoint_1':
            $productName = "药水1瓶装";
            break;
        case 'ActionPoint_2':
            $productName = "药水6瓶装";
            break; 
        case 'IAP_PRODUCT_CP12':
            $productName = "药水12瓶装";
            break;
        case 'SightLine':
            $productName = "瞄准线包";
            break;
        case 'StoneBroken':
            $productName = "融石药水包";
            break;
        default:
            // code...
            break;
        }
        return $productName;
    }
}
