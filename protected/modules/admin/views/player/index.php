<style type="text/css">
.red{background:#FFC0CB;}
.green{background:#B4EEB4;}
</style>

<h1>用户统计 - Player总览</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('index'), 'get', array('name' => 'index'));

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

echo CHtml::submitButton('submit',array('name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'date',
	'dataProvider' => $dataProvider,
	'columns' => array(
		array(
			'name' => 'date',
			'header' => '日期',
			'value' => 'date("Y-m-d", $data["date"])',
			'htmlOptions' => array(
				'style' => 'text-align: center;',
			),
		),
		array(
		   'name' => 'dnu',
		   'header' => 'DNU',
		   'value' => 'PlayerSummary::model()->getCompareByKey($data, "dnu")',
		   'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "dnu")',
		),
		array(
		  'name' => 'dau',
		  'header' => 'DAU',
		  'value' => 'PlayerSummary::model()->getCompareByKey($data, "dau")',
		  'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "dau")',
		),
		array(
			'name' => 'ydau',
			'header' => '昨日登录',
			'value' => '$data["ydau"]',
		),
		array(
			'name' => 'nydau',
			'header' => '昨日未登录',
			'value' => '$data["nydau"]',
		),
		array(
			'name' => 'total',
			'header' => '总用户',
			'cssClassExpression' => '$data["total"]',
			'value' => '$data["total"]',
		),
		array(
		  'name' => 'vip_today',
		  'header' => '当日付费用户',
		  'value' => 'PlayerSummary::model()->getCompareByKey($data, "vip_today")',
		  'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "vip_today")',
		),
		array(
		  'name' => 'vip_increase',
		  'header' => '新增付费用户',
		  'value' => 'PlayerSummary::model()->getCompareByKey($data, "vip_increase")',
		  'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "vip_increase")',
		),
		array(
			'name' => 'vip_total',
			'header' => '付费用户总数',
			'value' => '$data["vip_total"]',
		),
	),
));
