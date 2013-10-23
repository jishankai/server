<h1>用户统计 - 用户详细</h1>
<br>
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<?php $this->renderPartial("menu",array("player"=>$player)); ?>
</div>
</div>
</div>

<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/fullcalendar.min.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.print.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.css" />
<script type='text/javascript'>
$(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
	   $('#calendar').fullCalendar({
	    monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],   
        monthNamesShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],   
        dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],   
        dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"],   
        buttonText:{today:"今天"},
        editable: true,
        events: [
            <?php foreach($playerLoginMonth as $player){
			
			  $strLog=strrev(decbin($player->loginDetail));//转化为2进制字符串,然后反转
			  $logArr=str_split($strLog);//获取每天的数组
			  
			?>
			     <?php foreach($logArr as $key=>$day){
				   if($day==0)continue;//跳过
				 ?>
			  
				{

					title: '<img src="admin/images/playerLogin.png" />',

					start: new Date(<?php echo date("Y",$player->loginMonth);?>,<?php echo intval(date("n",$player->loginMonth))-1;?>, <?php echo $key+1;?>)

				},
         <?php 
		 }
		 }?>
		    <?php if($loginFlag){//今天是否登陆过?>
			  {

					title: '<img src="admin/images/playerLogin.png" />',

					start: new Date(y,m,d)

				},
			
			<?php }?>
				
			]

		});

		

	});
</script>
<div id='calendar'></div>
