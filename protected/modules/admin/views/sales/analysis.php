<style type="text/css">
.red{background:#FFC0CB;}
.green{background:#B4EEB4;}
</style>

<h1>销售统计 - 充值分析</h1>
<br>
<a class="attachLoading z-button fl" href="<?php echo $this->createUrl('analysis', array('mod' => 'month')); ?>"<?php if(isset($_GET['mod']) && $_GET['mod'] == 'week'){ ?> style="color:red;"<?php } ?>>月报表</a>
<a class="attachLoading z-button fl" href="<?php echo $this->createUrl('analysis', array('mod' => 'week')); ?>"<?php if(!isset($_GET['mod']) || $_GET['mod'] == 'month'){ ?> style="color:red;"<?php } ?>>周报表</a>
<a id="US" class="moneyType attachLoading z-button fr" href="#">美元</a>
<a id="RMB" class="moneyType attachLoading z-button fr" href="#">人民币</a>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'analysis',
	'dataProvider' => $dataProvider,
	'columns' => array(
			array(           
				'name'=>'日期段',
				'value'=>'date("Y-m",$data["date"])',
				'visible'=>!isset($_GET['mod']) || $_GET['mod'] == 'month',
			),
			array(           
				'name'=>'日期段',
				'value'=>'date("Y-m-d",$data["date"])."~".date("Y-m-d",$data["date"]+86400*6)',
				'visible'=>isset($_GET['mod']) && $_GET['mod'] == 'week',
			),
			array(           
				'name'=>'销售额(美元)',
                'value' => 'UserSummary::model()->getCompareByKey($data, "dollar")',
      		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "dollar")',
				'htmlOptions' => array(
					'class' => 'moneyDoller',
				),
				'headerHtmlOptions' => array(
					'class' => 'moneyDoller',
				),				
			),
			array(           
				'name'=>'销售额(人民币)',
				'value' => 'UserSummary::model()->getCompareByKey($data, "rmb")',
      		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "rmb")',
				'htmlOptions' => array(
					'class' => 'moneyRMB',
				),
				'headerHtmlOptions' => array(
					'class' => 'moneyRMB',
				),				
			),
			array(           
				'name'=>'AU',
				'value' => 'UserSummary::model()->getCompareByKey($data, "au")',
      		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "au")',
			),
			array(           
				'name'=>'ARPU(美元)',
				'value'=>'$data["au"]?round($data["dollar"]/$data["au"], 2):0',
				'htmlOptions' => array(
					'class' => 'moneyDoller',
				),
				'headerHtmlOptions' => array(
					'class' => 'moneyDoller',
				),				
			),
			array(           
				'name'=>'ARPU(人民币)',
				'value'=>'$data["au"]?round($data["rmb"]/$data["au"], 2):0',
				'htmlOptions' => array(
					'class' => 'moneyRMB',
				),
				'headerHtmlOptions' => array(
					'class' => 'moneyRMB',
				),				
			),
			array(           
				'name'=>'PU',
				'value' => 'UserSummary::model()->getCompareByKey($data, "pu")',
      		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "pu")',
			),
			array(           
				'name'=>'ARPPU(美元)',
				'value'=>'$data["pu"]?round($data["dollar"]/$data["pu"], 2):0',
				'htmlOptions' => array(
					'class' => 'moneyDoller',
				),
				'headerHtmlOptions' => array(
					'class' => 'moneyDoller',
				),				
			),
			array(           
				'name'=>'ARPPU(人民币)',
				'value'=>'$data["pu"]?round($data["rmb"]/$data["pu"], 2):0',
				'htmlOptions' => array(
					'class' => 'moneyRMB',
				),
				'headerHtmlOptions' => array(
					'class' => 'moneyRMB',
				),				
			),
		),
	)
);
?>
<style>
#RMB {color:red}
.moneyRMB {display:none;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('.moneyType').click(function(){
		if(this.id == 'RMB'){
			$("#RMB").css("color", "white");
			$("#US").css("color", "red");
			$(".moneyDoller").hide();
			$(".moneyRMB").show();
		}
		else
		{
			$("#RMB").css("color", "red");
			$("#US").css("color", "white");
			$(".moneyDoller").show();
			$(".moneyRMB").hide();
		}
		return false;
	})
	$('.yiiPager a').live("click","",function(){
		$("#RMB").css("color", "white");
		$("#US").css("color", "red");
		return false;
	});
})
</script>
