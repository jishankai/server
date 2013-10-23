<style type="text/css">
.color0{background:#D1EEEE;}
.color1{background:#FFEBCD;}
.color2{background:#FFD700;}
.color3{background:#FFC0CB;}
.color4{background:#FF7F50;}
</style>

<h1>用户统计 - 付费玩家追踪</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('vip'), 'get', array('name' => 'vip'));

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'startTime',
    'options'=>array(
        'showAnim'=>'fold',
		'showOn'=>"both",
		'buttonImage'=>Yii::app()->request->baseUrl."/admin/images/jqueryui/calendar.gif",
        'dateFormat' => 'yy-mm-dd',
		
    ),
	'value' => date('Y-m-d', $startTime),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
	
));
?>
~
<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'endTime',
    'options'=>array(
        'showAnim'=>'fold',
		'showOn'=>"both",
		'buttonImage'=>Yii::app()->request->baseUrl."/admin/images/jqueryui/calendar.gif",
        'dateFormat' => 'yy-mm-dd',
		
    ),
	'value' => date('Y-m-d', $endTime),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
   
));
echo CHtml::hiddenField('money', '0');
echo CHtml::submitButton('submit',array('id' => 'search', 'name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();
?>
<br>
<table width="550" cellspacing="3">
	<tbody>
		<tr>
			<td bgcolor="#D1EEEE" height="30" width="30"></td>
			<td>当前天或昨天</td>
			<td bgcolor="#FFEBCD" height="30" width="30"></td>
			<td>前2~3天</td>
			<td bgcolor="#FFD700" height="30" width="30"></td>
			<td>前4~6天</td>
			<td bgcolor="#FFC0CB" height="30" width="30"></td>
			<td>前7~13天</td>
			<td bgcolor="#FF7F50" height="30" width="30"></td>
			<td>14天前</td>
		</tr>
	</tbody>
</table>

<a id="money0" class="moneyType attachLoading z-button fr" href="#" <?php if($money == 0){?>style="color:red;"<?php }?>>美元</a>
<a id="money1" class="moneyType attachLoading z-button fr" href="#" <?php if($money == 1){?>style="color:red;"<?php }?>>人民币</a>
<?php
if($money == 0){
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'playerId',
		'dataProvider' => $DollarDataProvider,
		'rowCssClassExpression' => 'Recharge::model()->compareDate($data["loginTime"])',
		'columns' => array(
			array('name' => 'no', 'header' => '序号', 'value' => '$data["no"]'),
			array(
				'class' => 'CLinkColumn',
				'header' => '用户名',
				'labelExpression' => '$data["name"]',
				'urlExpression' => 'Yii::app()->createUrl("admin/player/detail", array("playerId" => $data["playerId"]))',
				'htmlOptions' => array(
					'style' => 'text-decoration: underline',
				),
			),
			array('name' => 'searchDollar', 'header' => '查询时段内充值', 'value' => '$data["searchDollar"]'),
			//显示美元
			array(
				'name' => 'weekDollar',
				'header' => '本周充值',
				'id' => '123',
				'value' => '$data["weekDollar"]',
			),
			array(
				'name' => 'preWeekDollar',
				'header' => '上周充值',
				'value' => '$data["preWeekDollar"]',
			),
			array(
				'name' => 'monthDollar',
				'header' => '本月充值',
				'value' => '$data["monthDollar"]',
			),
			array(
				'name' => 'preMonthDollar',
				'header' => '上月充值',
				'value' => '$data["preMonthDollar"]',
			),
			array(
				'name' => 'loginTime',
				'header' => '最后登录时间',
				'value' => 'date("Y-m-d H:i:s", $data["loginTime"])',
				'htmlOptions' => array(
					'style' => 'text-align: center;',
				),
			),
		),
	));
}else{
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'playerId',
		'dataProvider' => $RMBDataProvider,
		'rowCssClassExpression' => 'Recharge::model()->compareDate($data["loginTime"])',
		'columns' => array(
			array('name' => 'no', 'header' => '序号', 'value' => '$data["no"]'),
			array(
				'class' => 'CLinkColumn',
				'header' => '用户名',
				'labelExpression' => '$data["name"]',
				'urlExpression' => 'Yii::app()->createUrl("admin/player/detail", array("playerId" => $data["playerId"]))',
				'htmlOptions' => array(
					'style' => 'text-decoration: underline',
				),
			),
			array('name' => 'searchDollar', 'header' => '查询时段内充值', 'value' => '$data["searchRMB"]'),
			//显示人民币
			array(
				'name' => 'weekRMB',
				'header' => '本周充值',
				'value' => '$data["weekRMB"]',
			),
			array(
				'name' => 'preWeekRMB',
				'header' => '上周充值',
				'value' => '$data["preWeekRMB"]',
			),
			array(
				'name' => 'monthRMB',
				'header' => '本月充值',
				'value' => '$data["monthRMB"]',
			),
			array(
				'name' => 'preMonthRMB',
				'header' => '上月充值',
				'value' => '$data["preMonthRMB"]',
			),
			array(
				'name' => 'loginTime',
				'header' => '最后登录时间',
				'value' => 'date("Y-m-d H:i:s", $data["loginTime"])',
				'htmlOptions' => array(
					'style' => 'text-align: center;',
				),
			),
		),
	));
}
?>

<script type="text/javascript">
$(document).ready(function(){
	$('.moneyType').click(function(){
		moneyId = this.id.slice(-1);
		$('#money').attr('value', moneyId);
		$('#search').click();
	})
})
</script>
