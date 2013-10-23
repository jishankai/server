<?php
/*require(dirname(__FILE__).'/ApnStupid/ApnStupid_Exception.php');
require(dirname(__FILE__).'/ApnStupid/ApnStupid_Push.php');
require(dirname(__FILE__).'/ApnStupid/ApnStupid_Message.php');*/

class PlayerController extends Controller
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
        $sql .= 'from admin_PlayerSummary ';
        $sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
        $sql .= 'order by date';
        $summary = Yii::app()->db->createCommand($sql)->queryAll();

        //查询时间是否包括今日
        if($startTime <= $todayStart && $endTime >= $todayStart) {
            $cron = new CronSql();
            $todaySummarys = $cron->cronPlayerSummary($todayStart, $todayEnd);
            $count = count($summary);
            $summary[$count]['date'] = $todaySummarys['date'];
            $summary[$count]['dnu'] = $todaySummarys['dnu'];
            $summary[$count]['dau'] = $todaySummarys['dau'];
            $summary[$count]['ydau'] = $todaySummarys['ydau'];
            $summary[$count]['total'] = $todaySummarys['total'];
            $summary[$count]['vip_total'] = $todaySummarys['vip_total'];
            $summary[$count]['vip_today'] = $todaySummarys['vip_today'];
            $summary[$count]['vip_increase'] = $todaySummarys['vip_increase'];
            $summary[$count]['createTime'] = $todaySummarys['createTime'];
            $summary[$count]['updateTime'] = date('Y-m-d H:i:s');
        }//print_r($summary);print_r($todaySummarys);
        //将每条数据的key提取出来,同时计算昨日未登录
        $temp = array();
        foreach($summary as $key => $value){
            $summary[$key]['key'] = $key;
            $summary[$key]['nydau'] = $value['dau'] - $value['ydau'];
            $summary[$key]['pre'] = $temp;
            $temp = $value;
        }

        $dataProvider = new CArrayDataProvider($summary, array(
            'keyField' => 'date',
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
        $this->render('index', compact('startTime', 'endTime', 'dataProvider', 'summary'));
    }

    public function actionStats()
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
        $sql .= 'from admin_StatsSummary ';
        $sql .= 'where date>='.$startTime.' and date<='.$endTime.' ';
        $sql .= 'order by date';
        $summary = Yii::app()->db->createCommand($sql)->queryAll();

        //查询时间是否包括今日
        if($startTime <= $todayStart && $endTime >= $todayStart) {
            $cron = new CronSql();
            $todaySummarys = $cron->cronStatsSummary($todayStart, $todayEnd);
            $count = count($summary);
            $summary[$count]['date'] = $todaySummarys['date'];
            $summary[$count]['world'] = $todaySummarys['world'];
            $summary[$count]['practice'] = $todaySummarys['practice'];
            $summary[$count]['flee'] = $todaySummarys['flee'];
            $summary[$count]['regular'] = $todaySummarys['regular'];
            $summary[$count]['total'] = $todaySummarys['total'];
            $summary[$count]['createTime'] = $todaySummarys['createTime'];
            $summary[$count]['updateTime'] = date('Y-m-d H:i:s');
        }//print_r($summary);print_r($todaySummarys);
        //将每条数据的key提取出来,同时计算昨日未登录

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
        $this->render('stats', compact('startTime', 'endTime', 'dataProvider', 'summary'));
    }

    public function actionScore()
    {		
        $time = strtotime(date("Y-m-d"));//获得当天开始时间
        //500
        $sql = 'SELECT "500" AS score, COUNT(*) AS scoreNum, SUM(login.loginTime>='.($time-6*24*3600).') AS activeNum, SUM(login.loginTime<'.($time-6*24*3600).') AS unActiveNum FROM battle JOIN login on battle.playerId = login.playerId WHERE score=50000';
        $scores[] = Yii::app()->db->createCommand($sql)->queryRow();
        //1500
        $sql = 'SELECT "1500" AS score, COUNT(*) AS scoreNum, SUM(login.loginTime>='.($time-6*24*3600).') AS activeNum, SUM(login.loginTime<'.($time-6*24*3600).') AS unActiveNum FROM battle JOIN login on battle.playerId = login.playerId WHERE score=150000';
        $scores[] = Yii::app()->db->createCommand($sql)->queryRow();
        //500~3200
        for ($i = 500; $i < 3200; $i+=100) {
            $sql = 'SELECT "'.$i.'~'.($i+100).'" AS score, COUNT(*) AS scoreNum, SUM(login.loginTime>='.($time-6*24*3600).') AS activeNum, SUM(login.loginTime<'.($time-6*24*3600).') AS unActiveNum FROM battle JOIN login on battle.playerId = login.playerId WHERE score>='.($i*100).' AND score<10000+'.($i*100);
            $scores[] = Yii::app()->db->createCommand($sql)->queryRow();
        }
        //total
        $sql = 'SELECT "总计" AS score, COUNT(*) AS scoreNum, SUM(login.loginTime>='.($time-6*24*3600).') AS activeNum, SUM(login.loginTime<'.($time-6*24*3600).') AS unActiveNum FROM battle JOIN login on battle.playerId = login.playerId';
        $scores[] = Yii::app()->db->createCommand($sql)->queryRow();

        $dataProvider = new CArrayDataProvider($scores, array(
            'keyField' => 'score',
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));
        $this->render('score', compact('dataProvider'));
    }

    public function actionSearch()
    {
        $sql = 'select p.playerId, name, inviteCode, score, rank, p.createTime, loginTime from (player p join battle on p.playerId=battle.playerId) join login on p.playerId=login.playerId';
        $condition = ' where 1';
        $find = array('playerId' => '', 'name' => '', 'inviteCode' => '', 'lowScore' => '', 'highScore' => '', 'lowRank' => '', 'highRank' => '');
        $illegal = false;
        if(isset($_GET['search'])){
            $search = $_GET;
            if($search['playerId'] !== ''){
                $find['playerId'] = $search['playerId'];
                $condition .= ' and p.playerId = "'.$search['playerId'].'"';
            }
            if($search['name'] !== ''){
                $find['name'] = $search['name'];
                $condition .= ' and name = "'.$search['name'].'"';
            }
            if($search['inviteCode'] !== ''){
                $find['inviteCode'] = $search['inviteCode'];
                $condition .= ' and inviteCode = "'.$search['inviteCode'].'"';
            }
            if($search['lowScore'] !== ''){
                $find['lowScore'] = $search['lowScore'];
                if($search['lowScore'] !== '0'){//当输入等级不为0时
                    if((int)$search['lowScore'] !== 0){//如果输入为不为'1,2'等的字符串
                        $condition .= ' and score >= "'.($search['lowScore']*100).'"';
                    }else{//如果输入为不为'0'的字符串(如'a','啊'),输入不合法
                        $illegal = true;
                    }
                }else{//当输入等级为0时,得到的$search['lowScore'] === '0'
                    $condition .= ' and score >= "'.($search['lowScore']*100).'"';
                }
            }
            if($search['highScore'] !== ''){
                $find['highScore'] = $search['highScore'];
                if($search['highScore'] !== '0'){//当输入等级不为0时
                    if((int)$search['highScore'] !== 0){//如果输入为不为'1,2'等的字符串
                        $condition .= ' and score <= "'.($search['highScore']*100).'"';
                    }else{//如果输入为不为'0'的字符串(如'a','啊'),输入不合法
                        $illegal = true;
                    }
                }else{//当输入等级为0时,得到的$search['lowScore'] === '0'
                    $condition .= ' and score <= "'.($search['lowScore']*100).'"';
                }
            }
            if($search['lowRank'] !== ''){
                $find['lowRank'] = $search['lowRank'];
                if($search['lowRank'] !== '0'){//当输入等级不为0时
                    if((int)$search['lowRank'] !== 0){//如果输入为不为'1,2'等的字符串
                        $condition .= ' and rank >= "'.$search['lowRank'].'"';
                    }else{//如果输入为不为'0'的字符串(如'a','啊'),输入不合法
                        $illegal = true;
                    }
                }else{//当输入等级为0时,得到的$search['lowRank'] === '0'
                    $condition .= ' and rank >= "'.$search['lowRank'].'"';
                }
            }
            if($search['highRank'] !== ''){
                $find['highRank'] = $search['highRank'];
                if($search['highRank'] !== '0'){//当输入等级不为0时
                    if((int)$search['highRank'] !== 0){//如果输入为不为'1,2'等的字符串
                        $condition .= ' and rank <= "'.$search['highRank'].'"';
                    }else{//如果输入为不为'0'的字符串(如'a','啊'),输入不合法
                        $illegal = true;
                    }
                }else{//当输入等级为0时,得到的$search['lowRank'] === '0'
                    $condition .= ' and rank <= "'.$search['lowRank'].'"';
                }
            }
        }
        $sql .= $condition;
        $sql .= ' order by rank asc, score desc, p.playerId asc';
        $player = Yii::app()->db->createCommand($sql)->queryAll();
        if($illegal){
            $player = array();
        }
        $playerDataProvider = new CArrayDataProvider($player, array(
            'keyField' => 'playerId',
            'pagination' => array(
                'pageSize' => 25,
            ),
        ));
        $this->render('search', compact('playerDataProvider', 'find', 'player'));
    }

    public function actionVip()
    {
        $weekTime = Recharge::model()->weekTime();
        $monthTime = Recharge::model()->monthTime();
        $conToday = false;//查询时间是否包括今日
        $startTime = $monthTime['monthStartTime'];//查询默认开始时间,本月第一天
        $endTime = strtotime(date("Y-m-d"));//查询默认结束时间,当前日零时
        $todayStart = strtotime(date("Y-m-d"));
        $todayEnd = $todayStart + 86400;
        $money = 0;//显示货币,当为美元：0,人民币：1
        if(isset($_GET['search'])){
            if(!empty($_GET['startTime']) && !empty($_GET['endTime'])){
                $startTime = strtotime($_GET['startTime']);
                $endTime = strtotime($_GET['endTime']);
                $money = $_GET['money'];
            }
        }
        if($startTime <= $todayStart && $endTime >= $todayStart){
            $conToday = true;
        }


        /*$sql = 'select r.playerId, playerName, ';
        $sql .= '(select sum(dollar) from admin_Recharge date >= '.$startTime.' and date <= '.$endTime.') searchRechargeCount, ';//查询时段内充值
        $sql .= 'sum(date >= '.$weekTime['weekStartTime'].' and date <= '.$weekTime['weekEndTime'].') weekRechargeCount, ';//本周充值
        $sql .= 'sum(date >= '.$weekTime['preWeekStartTime'].' and date <= '.$weekTime['preWeekEndTime'].') preWeekRechargeCount, ';//上周充值
        $sql .= 'sum(date >= '.$monthTime['monthStartTime'].' and date <= '.$monthTime['monthEndTime'].') monthRechargeCount, ';//本月充值
        $sql .= 'sum(date >= '.$monthTime['preMonthStartTime'].' and date <= '.$monthTime['preMonthEndTime'].') preMonthRechargeCount ';//上月充值
        $sql .= 'from admin_Recharge r, player p, player p ';
        $sql .= 'where r.playerId = p.playerId = p.playerId  ';
        $sql .= 'and p.playerId in(select playerId, from user)';*/

        //$sql = 'select r.playerId, playerName, dollar, rmb';
        //查询时段内充值
        $sqlSearch = 'select r.playerId, sum(dollar) searchDollar, sum(rmb) searchRMB ';
        $sqlSearch .= 'from admin_Recharge r, player p ';
        $sqlSearch .= 'where r.playerId = p.playerId ';
        $sqlSearch .= 'and date >= '.$startTime.' and date <= '.$endTime;
        $sqlSearch .= ' group by p.playerId';

        //本周充值
        $sqlWeek = 'select r.playerId, sum(dollar) weekDollar, sum(rmb) weekRMB ';
        $sqlWeek .= 'from admin_Recharge r, player p ';
        $sqlWeek .= 'where r.playerId = p.playerId ';
        $sqlWeek .= 'and date >= '.$weekTime['weekStartTime'].' and date <= '.$weekTime['weekEndTime'];
        $sqlWeek .= ' group by p.playerId';

        //上周充值
        $sqlPreWeek = 'select r.playerId, sum(dollar) preWeekDollar, sum(rmb) preWeekRMB ';
        $sqlPreWeek .= 'from admin_Recharge r, player p ';
        $sqlPreWeek .= 'where r.playerId = p.playerId  ';
        $sqlPreWeek .= 'and date >= '.$weekTime['preWeekStartTime'].' and date <= '.$weekTime['preWeekEndTime'];
        $sqlPreWeek .= ' group by p.playerId';

        //本月充值
        $sqlMonth = 'select r.playerId, sum(dollar) monthDollar, sum(rmb) monthRMB ';
        $sqlMonth .= 'from admin_Recharge r, player p ';
        $sqlMonth .= 'where r.playerId = p.playerId ';
        $sqlMonth .= 'and date >= '.$monthTime['monthStartTime'].' and date <= '.$monthTime['monthEndTime'];
        $sqlMonth .= ' group by p.playerId';

        //上月充值
        $sqlPreMonth = 'select r.playerId, sum(dollar) preMonthDollar, sum(rmb) preMonthRMB ';
        $sqlPreMonth .= 'from admin_Recharge r, player p ';
        $sqlPreMonth .= 'where r.playerId = p.playerId  ';
        $sqlPreMonth .= 'and date >= '.$monthTime['preMonthStartTime'].' and date <= '.$monthTime['preMonthEndTime'];
        $sqlPreMonth .= ' group by p.playerId';

        //查询所有充值用户
        $sqlRecharge = 'select i.*, p.*, l.* ';
        $sqlRecharge .= 'from ItunesPaymentTransaction i, player p, login l ';
        $sqlRecharge .= 'where i.playerId = p.playerId and i.playerId = l.playerId ';
        $sqlRecharge .= 'group by i.playerId, name ';
        $sqlRecharge .= 'order by i.playerId';

        $sqlTodayRecharge = 'select playerId, sum(dollar) todayUS, sum(price) todayRMB ';
        $sqlTodayRecharge .= 'from ItunesPaymentTransaction ';
        $sqlTodayRecharge .= 'where createTime >= '.$todayStart.' and createTime < '.$todayEnd;
        $sqlTodayRecharge .= ' group by playerId';

        //数据查询
        $search = Yii::app()->db->createCommand($sqlSearch)->queryAll();
        $week = Yii::app()->db->createCommand($sqlWeek)->queryAll();
        $preWeek = Yii::app()->db->createCommand($sqlPreWeek)->queryAll();
        $month = Yii::app()->db->createCommand($sqlMonth)->queryAll();
        $preMonth = Yii::app()->db->createCommand($sqlPreMonth)->queryAll();
        $recharge = Yii::app()->db->createCommand($sqlRecharge)->queryAll();
        $todayRecharge = Yii::app()->db->createCommand($sqlTodayRecharge)->queryAll();

        //将数据变成以playerId为key的数组
        $search = Recharge::model()->sortByPlayerId($search);
        $week = Recharge::model()->sortByPlayerId($week);
        $preWeek = Recharge::model()->sortByPlayerId($preWeek);
        $month = Recharge::model()->sortByPlayerId($month);
        $preMonth = Recharge::model()->sortByPlayerId($preMonth);
        $recharge = Recharge::model()->sortByPlayerId($recharge);
        $todayRecharge = Recharge::model()->sortByPlayerId($todayRecharge);

        $result = Recharge::model()->combine($recharge, $search, $week, $preWeek, $month, $preMonth, $todayRecharge, $conToday);
        $DollarResult = Recharge::model()->array_sort($result, 'searchDollar', 'desc');
        $RMBResult = Recharge::model()->array_sort($result, 'searchRMB', 'desc');
        //对数组加上顺序no
        $no = 1;
        foreach($DollarResult as $key => $value){
            $DollarResult[$key]['no'] = $no;
            $no++;
        }
        $no = 1;
        foreach($RMBResult as $key => $value){
            $RMBResult[$key]['no'] = $no;
            $no++;
        }
        $DollarDataProvider = new CArrayDataProvider($DollarResult, array(
            'keyField' => 'playerId',
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));
        $RMBDataProvider = new CArrayDataProvider($RMBResult, array(
            'keyField' => 'playerId',
            'pagination' => array(
                'pageSize' => 100,
            ),
        ));

        $this->render('vip', compact('DollarDataProvider', 'RMBDataProvider', 'startTime', 'endTime', 'money'));

    }

    public function actionDetail($playerId)
    {
        $player = BPPlayer::model()->findByPk($playerId);
        $device = BPDevice::model()->findByAttributes(array('playerId'=>$playerId));
        if(empty($player)) {
            echo "参数错误,用户ID不存在";
        } else {
            $this->render("detail", compact("player", "device"));
        }
    }

    public function actionban()
    {

        $playerId=intval($_POST['playerId']);
        $player=BPPlayer::model()->findByPk($playerId);
        $op=$_POST['op'];
        $type=$_POST['type'];//0为解除账号,1封账号
        if($type!=0&&$type!=1)
            $type=0;
        if(md5($op)===md5('admin'))
        {
            if(isset($player))
            {
                $transaction=$player->dbConnection->beginTransaction();
                try{
                    //修改ban号字段
                    $player->ban=$type;
                    $player->update(array('ban'));

                    $transaction->commit();
                    echo 0;//成功;
                }
                catch(Exception $e)
                {

                    $transaction->rollBack();
                    echo 2;//操作失败
                }


            }
            else
                echo 2;//操作失败
        }
        else
            echo 1;//操作码错误
    }

    public function actionLogin($playerId)
    {
        $today = strtotime(date("Y-m-d",time()));
        $loginFlag = false;//今天是否登陆
        $player = BPPlayer::model()->findByPk($playerId);
        $playerLoginMonth = PlayerLoginMonth::model()->findAllByAttributes(array('playerId' =>$playerId));//获取登陆月日志
        if ($player->getLogin()->loginTime>=$today) {
            $loginFlag=true;
        }

        $this->render("login",compact("playerLoginMonth","playerId",'loginFlag','player'));
    }

    public function actionBattle($playerId)
    {
        $battle = array();
        $player = BPPlayer::model()->findByPk($playerId);

        $battleIds = Yii::app()->db->createCommand('SELECT DISTINCT battleId FROM round WHERE playerId=:playerId')->bindValue(':playerId', $playerId)->queryColumn();
        foreach ($battleIds as $battleId) {
            $result = BPResult::model()->findByPk($battleId);
            if (empty($result)) {
                continue;
            }
            if ($result->playerId1==$playerId) {
                $opponentId = $result->playerId2;
                $finalResult = $result->result;
                $score_start = $result->score_start1;
                $score_final = $result->score_final1;
                $score_change = $score_final - $score_start;
                $rank_start = $result->rank_start1;
                $rank_final = $result->rank_final1;
                $rank_change = $rank_final - $rank_start;
            } else {
                $opponentId = $result->playerId1;
                $finalResult = $result->result*(-1);
                $score_start = $result->score_start2;
                $score_final = $result->score_final2;
                $score_change = $score_final - $score_start;
                $rank_start = $result->rank_start2;
                $rank_final = $result->rank_final2;
                $rank_change = $rank_final - $rank_start;
            }
            $sRounds = BPRound::model()->findAllByAttributes(array(
                'battleId' => $battleId,
                'playerId' => $playerId,
            ));
            $oPlayer = BPPlayer::model()->findByPk($opponentId);

            if (isset($oPlayer)) {
                $battle[$battleId] = array(
                    'time' => $result->startTime,
                    'opponentId' => $oPlayer->playerId,
                    'opponentName' => $oPlayer->name,
                    'result' => $finalResult,
                    'score' => '原:'.$score_start.' 现:'.$score_final.' 变:'.$score_change,
                    'rank' => '原:'.$rank_start.' 现:'.$rank_final.' 变:'.$rank_change,
                );
            } else {
                $battle[$battleId] = array(
                    'time' => $result->startTime,
                    'opponentId' => $opponentId,
                    'opponentName' => 'Robot',
                    'result' => $finalResult,
                    'score' => '原:'.$score_start.' 现:'.$score_final.' 变:'.$score_change,
                    'rank' => '原:'.$rank_start.' 现:'.$rank_final.' 变:'.$rank_change,
                );
            }

            foreach ($sRounds as $sRound) {
                $sPre = 'sr'.(3-$sRound->round).'_';
                $battle[$battleId][$sPre.'atk'] = $sRound->atk;
                $battle[$battleId][$sPre.'def'] = $sRound->def;
                $battle[$battleId][$sPre.'combo'] = $sRound->combo;
                $battle[$battleId][$sPre.'hp'] = $sRound->hp;
                $oRound = BPRound::model()->findByAttributes(array(
                    'battleId' => $battleId,
                    'round' => $sRound->round,
                    'playerId' => $opponentId,
                ));
                $oPre = 'or'.(3-$sRound->round).'_';
                if (isset($oRound)) {
                    $battle[$battleId][$oPre.'atk'] = $oRound->atk;
                    $battle[$battleId][$oPre.'def'] = $oRound->def;
                    $battle[$battleId][$oPre.'combo'] = $oRound->combo;
                    $battle[$battleId][$oPre.'hp'] = $oRound->hp;
                } else {
                    $battle[$battleId][$oPre.'atk'] = NULL;
                    $battle[$battleId][$oPre.'def'] = NULL;
                    $battle[$battleId][$oPre.'combo'] = NULL;
                    $battle[$battleId][$oPre.'hp'] = NULL;
                }
            }
        }

        $dataProvider = new CArrayDataProvider($battle, array(
            'keyField' => 'time',
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
        $this->render('battle', compact('dataProvider', 'player'));
    }

    public function actionProps($playerId)
    {
        $startTime = strtotime(date('Y-m'));//查询默认开始时间,本月第一天
        $endTime = strtotime(date("Y-m-d"));//查询默认结束时间,当前日零时
        if(!empty($_REQUEST['startTime']) && !empty($_REQUEST['endTime'])){
            $startTime = strtotime($_REQUEST['startTime']);
            $endTime = strtotime($_REQUEST['endTime']);
        }
        $endTime += 60*60*24;
        $player = BPPlayer::model()->findByPk($playerId);
        $propsLog = Yii::app()->db->createCommand('SELECT * FROM propsLog WHERE playerId=:playerId AND createTime>=:startTime AND createTime<=:endTime')->bindValues(array(
            ':playerId' => $playerId,
            ':startTime' => $startTime,
            ':endTime' => $endTime,
        ))->queryAll();

        $dataProvider = new CArrayDataProvider($propsLog, array(
            'keyField' => 'createTime',
            'pagination' => array(
                'pageSize' => 50,
            ),
        ));
        $this->render('props', compact('startTime', 'endTime', 'dataProvider', 'player'));
    }

    public function actionRecharge($playerId)
    {     
        $time=time();
        $player=BPPlayer::model()->findByPk($playerId);

        if(!empty($_REQUEST['dateFrom'])) {
            $dateFrom=strtotime($_REQUEST['dateFrom']);
        } else {
            $dateFrom=strtotime(date("Y-m",$time));//默认是本月1号
        }
        if(!empty($_REQUEST['dateTo'])) {
            $dateTo=strtotime($_REQUEST['dateTo'])+86400;
        } else {
            $dateTo=strtotime(date("Y-m-d",$time))+86400;//到今天
        }

        $sql="select id, createTime, dollar, price as rmb, props from ItunesPaymentTransaction where playerId=$playerId and createTime>=$dateFrom and createTime<$dateTo order by createTime desc";
        $rawData=Yii::app()->db->createCommand($sql)->queryAll();
        $dataProvider=new CArrayDataProvider($rawData, array(
            'keyField'=>'id',
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $dataSum=Yii::app()->db->createCommand("select '总计' as total, sum(dollar) as dollar, sum(price) as rmb, NULL as props from ItunesPaymentTransaction where playerId=$playerId and createTime>=$dateFrom and createTime<$dateTo")->queryRow();

        $this->render("recharge",array('dataProvider'=>$dataProvider,'player'=>$player,'dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'dataSum'=>$dataSum));

    }

    public function actionReward()
    {
		$model=new RewardForm;

		// collect user input data
		if(isset($_POST['RewardForm']))
		{
			$model->attributes=$_POST['RewardForm'];
            if($model->validate() && $model->sendRewards()) {
                echo 'success';
            } else {
                echo 'fail';
            }
		} else {
            $this->render('reward',array('model'=>$model));
		}
    }
}
