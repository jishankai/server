<?php $this->beginContent('/layouts/main'); ?>
<div id="ContactsPageView" class="ZurmoDefaultPageView ZurmoPageView PageView"  style="height:1100px;">
<div id="ZurmoDefaultView">
<div class="GridView" >
<div id="HeaderView"><!-- Start of themes/default/templates/HeaderView.xhtml --><div id="MainLogo" class="zurmo-logo"></div>
<div class="GridView">
<div id="HeaderLinksView"><div class="clearfix">
<div id="corp-logo"><span>进击的巨喵后台管理</span></div><div id="user-toolbar" class="clearfix">
<ul id="user-header-menu" class="headerNav nav">
<li  >
<a  style="float:left;margin-right:5px;" href="javascript:void(0);"><span><?php echo Yii::app()->user->name;?></span></a>
<a  style="float:left" href="<?php echo $this->createUrl("site/logout");?>"><span>退出</span></a>
</li>
</ul>


</div></div></div><div class="GridView"><div id="GlobalSearchView"></div></div></div>
</div><div class="AppContainer clearfix GridView" >
<div class="AppNavigation clearfix GridView" >

<div id="MenuView">
<ul class="nav">
<li><a href="#"><span></span><span>用户统计</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='player/index')echo 'class="active"';?>><a href="<?php echo $this->createUrl('player/index');?>"><span></span><span style="text-decoration: underline">Player总览</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='user/index')echo 'class="active"';?>><a href="<?php echo $this->createUrl('user/index');?>"><span></span><span style="text-decoration: underline">User总览</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='user/terminal')echo 'class="active"';?>><a href="<?php echo $this->createUrl('user/terminal');?>"><span></span><span style="text-decoration: underline">机种分布</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='player/score')echo 'class="active"';?>><a href="<?php echo $this->createUrl('player/score');?>"><span></span><span style="text-decoration: underline">积分分布</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='player/search')echo 'class="active"';?>><a href="<?php echo $this->createUrl('player/search');?>"><span></span><span style="text-decoration: underline">玩家检索</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='player/vip')echo 'class="active"';?>><a href="<?php echo $this->createUrl('player/vip');?>"><span></span><span style="text-decoration: underline">付费用户追踪</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='player/stats')echo 'class="active"';?>><a href="<?php echo $this->createUrl('player/stats');?>"><span></span><span style="text-decoration: underline">战斗次数统计</span></a></li>
<li ><hr/></li>
<li><a href="#"><span></span><span>销售统计</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='sales/index')echo 'class="active"';?>><a href="<?php echo $this->createUrl('sales/index');?>"><span></span><span style="text-decoration: underline">总览</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='sales/popular')echo 'class="active"';?>><a href="<?php echo $this->createUrl('sales/popular');?>"><span></span><span style="text-decoration: underline">热卖商品</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='sales/analysis')echo 'class="active"';?>><a href="<?php echo $this->createUrl('sales/analysis');?>"><span></span><span style="text-decoration: underline">充值分析</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='sales/detail')echo 'class="active"';?>><a href="<?php echo $this->createUrl('sales/detail');?>"><span></span><span style="text-decoration: underline">详细充值记录</span></a></li>
<li ><hr/></li>
<li><a href="#"><span></span><span>管理</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='news/admin')echo 'class="active"';?>><a href="<?php echo $this->createUrl('news/admin');?>"><span></span><span style="text-decoration: underline">公告管理</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='notice/admin')echo 'class="active"';?>><a href="<?php echo $this->createUrl('notice/admin');?>"><span></span><span style="text-decoration: underline">推送管理</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='player/reward')echo 'class="active"';?>><a href="<?php echo $this->createUrl('player/reward');?>"><span></span><span style="text-decoration: underline">奖励发放</span></a></li>
<li <?php  if($this->getId().'/'.$this->getAction()->id=='site/import')echo 'class="active"';?>><a href="<?php echo $this->createUrl('site/import');?>"><span></span><span style="text-decoration: underline">文件导入</span></a></li>
<li ><hr/></li>
</ul>

</div>

</div>
<div id="FlashMessageView"></div>
<div id="ActionBarSearchAndListView" class="AppContent GridView" >

<?php echo $content;?>

</div></div>
<script>
jQuery(function($) {
  $(".nav li").hover(
    function () {
      if ($(this).hasClass("parent")) {
        $(this).addClass("over");
      }
    },
    function () {
      $(this).removeClass("over");
    }
  );
});
</script>
<div id="ModalContainerView">
	<div id="modalContainer"></div>
</div>
<div id="ModalGameNotificationContainerView"></div>
<div id="FooterView">
	<!-- Start of themes/default/templates/FooterView.xhtml -->
	<a href="http://www.zurmo.com" id="credit-link" class="clearfix">
		<span>Copyright &#169;TCAT. All Rights reserved.</span>
	</a>
</div>
<?php $this->endContent(); ?>
