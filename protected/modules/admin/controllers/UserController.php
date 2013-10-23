<?php
/*require(dirname(__FILE__).'/ApnStupid/ApnStupid_Exception.php');
require(dirname(__FILE__).'/ApnStupid/ApnStupid_Push.php');
require(dirname(__FILE__).'/ApnStupid/ApnStupid_Message.php');*/

class UserController extends Controller
{
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
        $startTime = strtotime(date('Y-m'));//查询默认开始时间,本月第一天
        $endTime = strtotime(date("Y-m-d"));//查询默认结束时间,当前日零时
		$todayStart = strtotime(date("Y-m-d"));
		$todayEnd = $todayStart + 86400;
		if(isset($_GET['search'])){
			if(!empty($_GET['startTime']) && !empty($_GET['endTime'])){
				$startTime = strtotime($_GET['startTime']);
				$endTime = strtotime($_GET['endTime']);
			}
		}
		
		$sql = 'select * ';
		$sql .= 'from admin_UserSummary ';
		$sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
		$sql .= 'order by date';
		$summary = Yii::app()->db->createCommand($sql)->queryAll();
		$cron = new CronSql();
		$todaySummarys = $cron->cronUserSummary($todayStart, $todayEnd);
		//查询时间是否包括今日
		if($startTime <= $todayStart && $endTime >= $todayStart){
			$count = count($summary);
			$summary[$count]['date'] = $todaySummarys['date'];
			$summary[$count]['increase'] = $todaySummarys['increase'];
			$summary[$count]['register'] = $todaySummarys['register'];
			$summary[$count]['total'] = $todaySummarys['total'];
			$summary[$count]['createTime'] = $todaySummarys['createTime'];
			$summary[$count]['updateTime'] = date('Y-m-d H:i:s');
		}//print_r($summary);print_r($todaySummarys);
		//将每条数据的key提取出来,同时计算昨日未登录
		$temp = array();
		foreach($summary as $key => $value){
			$summary[$key]['key'] = $key;
            $value['increase']==0 ? $summary[$key]['transfer']=NULL : $summary[$key]['transfer'] = sprintf('%.2f%%', $value['register']/$value['increase']*100);
            $summary[$key]['unregister'] = $value['increase'] - $value['register'];
            $value['increase']==0 ? $summary[$key]['untransfer']=NULL : $summary[$key]['untransfer'] = sprintf('%.2f%%', ($value['increase'] - $value['register'])/$value['increase']*100);
			$summary[$key]['pre'] = $temp;
			$temp = $summary[$key];
		}
		
		$dataProvider = new CArrayDataProvider($summary, array(
			'keyField' => 'date',
			'pagination' => array(
				'pageSize' => 100,
			),
		));
		$this->render('index', compact('startTime', 'endTime', 'dataProvider', 'summary'));
    }

    public function actionTerminal()
	{
		$sqlos = 'select os, count(*) as osNum from device group by os order by count(*) desc';
		$sqlTerminal = 'select terminal, count(*) as terminalNum from device group by terminal order by count(*) desc';
		$sqlMix = 'select os, terminal, count(*) as mixNum from device group by terminal,os order by count(*) desc';
		$os = Yii::app()->db->createCommand($sqlos)->queryAll();
		$terminal = Yii::app()->db->createCommand($sqlTerminal)->queryAll();
		$mix = Yii::app()->db->createCommand($sqlMix)->queryAll();
		
		$osDataProvider = new CArrayDataProvider($os, array(
			'keyField' => 'os',
			'pagination' => array(
				'pageSize' => 30,
			),
		));
		$terminalDataProvider = new CArrayDataProvider($terminal, array(
			'keyField' => 'terminal',
			'pagination' => array(
				'pageSize' => 30,
			),
		));
		$mixDataProvider = new CArrayDataProvider($mix, array(
			'keyField' => 'os',
			'pagination' => array(
				'pageSize' => 30,
			),
		));
		
		$osCount = $terminalCount = $mixCount = 0;
		foreach($osDataProvider->rawData as $value){
			$osCount += $value['osNum'];
		}
		foreach($terminalDataProvider->rawData as $value){
			$terminalCount += $value['terminalNum'];
		}
		foreach($mixDataProvider->rawData as $value){
			$mixCount += $value['mixNum'];
		}
		$this->render('terminal', compact('osDataProvider', 'terminalDataProvider', 'mixDataProvider', 'osCount', 'terminalCount', 'mixCount'));
	}
}
