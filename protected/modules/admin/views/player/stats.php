<style type="text/css">
.red{background:#FFC0CB;}
.green{background:#B4EEB4;}
</style>

<h1>用户统计 - 战斗统计数据</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('stats'), 'get', array('name' => 'stats'));

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
		   'name' => 'world',
		   'header' => '世界',
		   'value' => 'PlayerSummary::model()->getCompareByKey($data, "world")',
		   'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "world")',
		),
		array(
		  'name' => 'practice',
		  'header' => '练习',
		  'value' => 'PlayerSummary::model()->getCompareByKey($data, "practice")',
		  'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "practice")',
		),
		array(
			'name' => 'flee',
			'header' => '逃跑',
			'value' => 'PlayerSummary::model()->getCompareByKey($data, "flee")',
		    'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "flee")',
		),
		array(
			'name' => 'regular',
			'header' => '正常',
			'value' => 'PlayerSummary::model()->getCompareByKey($data, "regular")',
		    'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "regular")',
		),
		array(
			'name' => 'total',
			'header' => '总数',
			'value' => 'PlayerSummary::model()->getCompareByKey($data, "total")',
		    'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "total")',
		),
	),
));
