<?php

class UserController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'checkSig',
        );    
    }

    public function actionLoginApi($uid, $ver, $token=NULL)
    {
        $device = MDevice::model()->findByAttributes(array('uid'=>$uid));
        $isVerify = ($ver==APP_VERSION_VERIFY);
        if(empty($device->playerId)){
            if($device === null){
                $device = new MDevice();
                $device->uid = $uid;
                $device->token = $token;
                $device->createTime = time();
                $device->save();
            }
            $session = Yii::app()->session;
            $session['id'] = $device->id;

            $this->echoJsonData(array(
                'result'=>false, 
                'isOpenInvite'=>!$isVerify, 
                'SID'=>$session->sessionID,
            ));
        } else {
            $player = MPlayer::model()->findByPk($device->playerId);
            if ($player->ban==1) {
                throw new MException("账号已被封");
            }
            $device = MDevice::model()->findByAttributes(array('uid'=>$uid));
            $device->token = $token;
            $device->saveAttributes(array('token'));

            $player->login();

            $session = Yii::app()->session;
            $session['playerId'] = $device->playerId;
            $this->echoJsonData(array(
                'result'=>true, 
                'isOpenInvite'=>!$isVerify,
                'SID'=>$session->sessionID,
            ));
        }
    }

    public function actionRegisterApi($name, $inviterCode, $term=NULL, $os=NULL)
    {
        if (empty($name)) {
            throw new MException('注册信息不完整');
        }
        $session = Yii::app()->session;
        $session->open();
        $id = $session['id'];
        if (empty($id)) {
            $this->response->setError(102, '重新登录');//重新登录
            $this->response->render();
        }

        $device = MDevice::model()->findByPk($id);
        if (empty($device)) {
            throw new MException('未登录');
        }
        if (MPlayer::model()->isNameExist(trim($name))) {
            throw new MException('用户名已被注册');
        }
        $namelen = (strlen($name)+mb_strlen($name,"UTF8"))/2;
        if ($namelen>12) {
            throw new MException('用户名超过最大长度');
        }
        $pattern = '/^[a-zA-Z0-9\x{30A0}-\x{30FF}\x{3040}-\x{309F}\x{4E00}-\x{9FBF}]+$/u';
        if (!preg_match($pattern, $name)) {
            throw new MException("用户名含有特殊字符");
        }
        $pattern = '/^令|王|江|周|胡|刘|李|吴|毛|温|习|贺|贾|彭|潭|轭|馿|府.*微|微.*府|谷丽萍|替考|代考网|计划|法拉利|北京.*车祸|车祸.*北京|高速.*车震|车震.*高速|车祸.*车震|车震.*车祸|作弊器|马驰.*新加坡|新加坡.*马驰|自由光诚|陈光诚事件|光诚.*沂南|沂南.*光诚|陈光诚.*使馆|使馆.*陈光诚|职称英语.*答案|答案.*职称英语|公务员.*答案|答案.*公务员|薄瓜瓜|海伍德|尼尔伍德|heywood|neil.*wood|wood.*neil|天线宝宝.*康师傅|康师傅.*天线宝宝|天线宝宝.*方便面|方便面.*天线宝宝|天线宝宝.*轮胎|轮胎.*天线宝宝|轮胎.*方便面|方便面.*轮胎|政变|枪声|戒严|3\\.19|北京事件|北京.*出事了|出事了.*北京|北京怎么了|不厚|薄督|谷开来|重庆|叶城.*砍杀|砍杀.*叶城|连承敏|弟弟.*睡|睡.*弟弟|要有光.*要有诚|要有诚.*要有光|杨杰|陈刚|山水文园|跑官|移动.*十年兴衰|十年兴衰.*移动|陈坚|戴坚|冯珏|罗川|马力|盛勇|谢岷|谢文|杨希|叶兵|张斌|陈瑞卿|高念书|华如秀|鲁向东|曲乃杰|孙静晔|涂志森|于剑鸣|张晓明|赵志强|郑建源|先皇|太上皇|蛤蟆|驾崩|丘小雄|公诉|右派|增城|暴动|宣言|莫日根|内蒙古.*抗议|抗议.*内蒙古|西乌旗|方滨兴|moli|麦当劳|天府|人民公园|广场|埃及|突尼斯|茉莉|jasmine.*revolution|revolution.*jasmine|集会|革命|齐鲁银行|公开信|高考时间|诺贝尔和平奖|被就业|小屋|日记|鲁昕|天安.*事件|事件.*天安|1989.*天安門|天安門.*1989|天安门|八九|六四|六 四|六\\.四|平反64|5月35日|5月35号|89动乱|89.*学生动乱|学生动乱.*89|89.*学生运动|学生运动.*89|64.*学生运动|学生运动.*64|64.*镇压|镇压.*64|64.*真相|真相.*64|64memo|tiananmen|8964|学潮|罢课|民运|学运|学联|学自联|高自联|工自联|民联|民阵|中国民主党|中国民主正义党|中国民主运动|世纪中国基金会|坦克人|挡坦克|tankman|木犀地|维园晚会|blood is on the square|姜维平|艾未未|艾末末|路青|发课|瓷瓜子|余杰|辛子陵|茅于轼|铁流|liu.*xiaobo|xiaobo.*liu|蟹农场|陈西|谭作人|高智晟|冯正虎|丁子霖|唯色|焦国标|何清涟|耀邦|紫阳|方励之|严家其|鲍彤|鮑彤|鲍朴|柴玲|乌尔凯西|封从德|炳章|苏绍智|陈一谘|韩东方|辛灏年|曹长青|陈破空|盘古乐队|盛雪|伍凡|魏京生|司徒华|黎安友|防火长城|great.*firewall|firewall.*great|gfw.*什么|什么.*gfw|国家防火墙|翻墙|代理|vpn.*免费|免费.*vpn|vpn.*下载|下载.*vpn|vpn.*世纪|世纪.*vpn|hotspot.*shield|shield.*hotspot|无界|ultrasurf|^freenet|safeweb|动态网|花园网|^cache|阅后即焚|法轮|轮大法|falun|明慧|minghui|退党|三退|九评|nine commentaries|洪吟|神韵艺术|神韵晚会|人民报|renminbao|纪元|^dajiyuan|epochtimes|新唐人|ntdtv|ndtv|新生网|^xinsheng|正见网|zhengjian|追查国际|真善忍|轮大法|法会|正念|经文|天灭|天怒|讲真相|马三家|善恶有报|活摘器官|群体灭绝|中功|张宏堡|地下教会|冤民大同盟|达赖|藏独|freetibet|雪山狮子|西藏流亡政府|青天白日旗|民进党|洪哲胜|独立台湾会|台湾政论区|台湾自由联盟|台湾建国运动组织|台湾.*独立联盟|独立联盟.*台湾|新疆.*独立|独立.*新疆|东土耳其斯坦|east.*turkistan|turkistan.*east|世维会|迪里夏提|美国之音|自由亚洲电台|记者无疆界|维基解密.*中国|中国.*维基解密|facebook|twitter|推特|新京报|世界经济导报|中国数字时代|^ytht|新语丝|^creaders|^tianwang|中国.*禁闻|禁闻.*中国|阿波罗网|阿波罗新闻|大参考|^bignews|多维|看中国|博讯|^boxun|peacehall|^hrichina|独立中文笔会|轻舟快讯|华夏文摘|开放杂志|大家论坛|华夏论坛|中国论坛|木子论坛|争鸣论坛|外交与方略|大中华论坛|反腐败论坛|新观察论坛|新华通论坛|正义党论坛|热站政论网|华通时事论坛|华语世界论坛|华岳时事论坛|两岸三地论坛|南大自由论坛|人民之声论坛|万维读者论坛|你说我说论坛|东西南北论坛|东南西北论谈|知情者|红太阳的陨落|和谐拯救危机|血房|一个孤僻的人|零八.*宪章|宪章.*零八|08.*宪章|宪章.*08|八宪章|8宪章|零八.*纲领|纲领.*零八|零八.*县长|县长.*零八|08县长|淋巴县长|我的最后陈述|我没有敌人|河殇|天葬|黄祸|我的奋斗|历史的伤口|改革.*历程|历程.*改革|国家的囚徒|prisoner of the state|改革年代的政治斗争|改革年代政治斗争|关键时刻|超越红墙|梦萦未名湖|一寸山河一寸血|政治局常委内幕|北国之春|中国之春|京之春|中南海红卡|中南海事件|东方红时空|纳米比亚|婴儿汤|泄题|罢餐|月月|代开.*发票|发票.*代开|钓鱼岛|^triangle|女保镖|玩ps|玩photoshop|chinese people eating babies|开枪|迫害|酷刑|邪恶|洗脑|网特|内斗|党魁|文字狱|一党专政|一党独裁|新闻封锁|老人政治|^freedom|^freechina|反社会|维权人士|维权律师|异见人士|异议人士|地下刊物|高瞻|共产|共铲党|共残党|共惨党|共惨裆|共匪|赤匪|中共|中宣|真理部|十八大|18大|太子|上海帮|团派|北京当局|裆中央|九常委|九长老|九哥|锦涛|家宝|影帝|近平|回良玉|汪洋|张高丽|俞正声|徐才厚|郭伯雄|熙来|梁光烈|孟建柱|戴秉国|马凯|令计划|韩正|章沁生|陈世炬|泽民|贼民|邓小平|庆红|罗干|假庆淋|hujin|wenjiabao|xijinping|likeqiang|zhouyongkang|lichangchun|wubangguo|heguoqiang|jiaqinglin|jiangzemin|xjp|jzm|色情|花花公子|tits|boobs|^\\s*海峰\\s*$|^\\s*威视公司\\s*$|^\\s*nuctech\\s*$|^\\s*逍遥游\\s*$|^\\s*自由门\\s*$|^\\s*自由門\\s*$|^\\s*自由之门\\s*$|^\\s*freegate\\s*$|^\\s*freegate download\\s*$|^\\s*download freegate\\s*$|^\\s*自由门下载\\s*$|^\\s*自由門下載\\s*$|^\\s*無界瀏覽\\s*$|^\\s*無界浏览\\s*$|^\\s*动网通\\s*$|^\\s*dynaweb\\s*$|^\\s*dongtaiwang\\s*$/u';
        if (preg_match($pattern, $name)) {
            throw new MException("用户名非法");
    }
    if ($inviterCode != '') {
        if (!$inviterId = MPlayer::model()->getPlayerIdByCode(strtolower(trim($inviterCode)))) {
            throw new MException("邀请ID不存在");
    }
    }

    $transaction = Yii::app()->db->beginTransaction();
    try {
        $player = $device->register(trim($name), $character, empty($inviterId)?NULL:$inviterId, $term, $os);
        $transaction->commit();

        $player->login();
        $session['playerId'] = $device->playerId;
        $this->echoJsonData(array('result'=>true));
    } catch (Exception $e) {
        $transaction->rollback();
        throw $e;
    }
    }

    public function actionLogin($uid=null)
    {
        if(!YII_DEBUG){
            Yii::app()->end();
    }
    if(isset($uid)){
        $this->redirect(array('loginApi', 'uid'=>$uid, 'sig'=>$this->getSig($uid)));
    } else{
        $this->render('login');
    }
    }

    public function actionSetToken() {
        if (isset($_GET['uid']) && isset($_GET['token']) && isset($_GET['te']) 
            && ((isset($_GET['sig']) && $_GET['sig'] == Util::getSignification($_GET['uid'] . $_GET['token'] . $_GET['te'])) || !CHECK_SIG_FLAG)
        ) {
            MDevice::setToken($_GET['uid'], $_GET['token']);
    }
else {
    throw new SException(Yii::t('View', 'param error'));
    }
    }

    public function actionSetDevice($device, $os, $version)
    {
        $session = Yii::app()->session;
        $session->open();
        $id = $session['id'];
        MDevice::setDevice($id, $device, $os, $version);
    }
}
