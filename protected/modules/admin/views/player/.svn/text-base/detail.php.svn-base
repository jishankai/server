<h1>用户统计 - 用户详细</h1>
<br>
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<?php $this->renderPartial("menu",array("player"=>$player)); ?>
</div>
</div>
</div>

<table class="items">
<thead>
<tr>
<th id="yw0_c0"  colspan=2 style="text-align:center">用户详细</th></tr>
</thead>
<tbody>
<tr class="odd"><td width="20%">playerId</td><td width="20%"><?php echo $player->playerId;?></td></tr>
<tr class="even"><td>玩家名称</td><td><?php echo $player->name;?></td></tr>
<tr class="odd"><td>角色形象</td><td><?php echo $player->character;?></td></tr>
<tr class="even"><td>招待ID</td><td><?php echo $player->inviteCode;?></td></tr>
<tr class="odd"><td>积分</td><td><?php echo $player->getBattle()->score/100;?></td></tr>
<tr class="even"><td>排名</td><td><?php echo number_format($player->getBattle()->rank);?></td></tr>
<tr class="odd"><td>胜率</td><td><?php echo round($player->getBattle()->win*100/($player->getBattleTimes()==0?1:$player->getBattleTimes()), 2);?>%</td></tr>
<tr class="even"><td>基础战绩</td><td>胜:<?php echo $player->getBattle()->win;?>&nbsp平:<?php echo $player->getBattle()->draw;?>&nbsp负:<?php echo $player->getBattle()->lose;?></td></tr>
<tr class="odd"><td>战斗战绩</td><td>攻:<?php echo $player->getStats()->aveatk;?>&nbsp防:<?php echo $player->getStats()->avedef;?>&nbsp连击数:<?php echo $player->getStats()->avecombo;?></td></tr>
<tr class="odd"><td>注册时间</td><td><?php echo date("Y-m-d H:i:s",$player->createTime);?></td></tr>
<tr class="even"><td>登陆时间</td><td><?php echo date("Y-m-d H:i:s",$player->getLogin()->loginTime);?></td></tr>
<tr class="odd"><td>机种/系统</td><td><?php echo empty($device) ? "" : $device->terminal.'/'.$device->os;?></td></tr>
<tr class="even"><td>账号状态</td><td><span id="status"><?php echo $player->ban==0?"正常":"已封号";?></span>
   <input type="button" value="封号" class="attachLoading z-button" onclick="ban(1)" id="ban" <?php if($player->ban!=0)echo "style='display:none'"?> />
   <input type="button" value="解封" class="attachLoading z-button" onclick="ban(0)" id="disBan" <?php if($player->ban==0)echo "style='display:none'"?> />
</td></tr>
</tbody>
</table>
<input type="hidden" value=<?php echo $player->name;?> name="name" id="name" />
<input type="hidden" value=<?php echo $player->playerId;?> name="playerId" id="playerId" />

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.ui.draggable.js" type="text/javascript"></script>     <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.alerts.js" type="text/javascript"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />    
<script>
function ban(type)
{

    var playerId=$("#playerId").val();
    var name=$("#name").val();
    var typeText=type==0?"解封":"封号";
    jConfirm("你确定要将<span style='color:blue'>"+name+"</span><span style='color:red'>"+typeText+"</span>吗?<br/>", '禁账号提示', function(r) {
        if(r){
            jPrompt('请输入操作码:', '', '操作码', function(r) {
                if(r){
                    var op=r;
                    $.post('<?php echo $this->createUrl("ban")?>',{playerId:playerId,type:type,op:op},function(msg)
                {
                    if(msg==0)
                    {
                        jAlert('success', typeText+'成功', '提示');
                        if(type)
                        {
                            $("#ban").hide();
                            $("#disBan").show();
                            $("#status").html('已封号');
                        }
                        else
                        {
                            $("#ban").show();
                            $("#disBan").hide();
                            $("#status").html('正常');
                        }
                    }
                    else if(msg==1)
                        jAlert('warning', '操作码错误', '提示');
                    else
                        jAlert('info', '操作失败,稍后重试', '提示');
                });
                }
                else if(r!=null)
                {
                    jAlert('warning', '请输入操作码', '提示');
                }
            });
        }
    });

}
</script>
