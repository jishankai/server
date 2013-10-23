<style type="text/css">
.red{background:#FFC0CB;}
.green{background:#B4EEB4;}
</style>

<h1>用户统计 - User总览</h1>
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
		   'name' => 'increase',
		   'header' => '当日新增',
		   'value' => 'UserSummary::model()->getCompareByKey($data, "increase")',
		   'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "increase")',
		),
		array(
		  'name' => 'register',
		  'header' => '当日注册',
		  'value' => 'UserSummary::model()->getCompareByKey($data, "register")',
		  'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "register")',
		),
		array(
			'name' => 'transfer',
			'header' => '当日转化率',
			'value' => 'UserSummary::model()->getCompareByKey($data, "transfer")',
		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "transfer")',
		),
		array(
			'name' => 'unregister',
			'header' => '尚未注册',
			'value' => 'UserSummary::model()->getCompareByKey($data, "unregister")',
		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "unregister")',
		),
        array(
			'name' => 'untransfer',
			'header' => '未注册率',
			'value' => 'UserSummary::model()->getCompareByKey($data, "untransfer")',
		    'cssClassExpression' => 'UserSummary::model()->getBackgroundByKey($data, "untransfer")',
		),
		array(
			'name' => 'total',
			'header' => '总用户',
			'cssClassExpression' => '$data["total"]',
			'value' => '$data["total"]',
		),
	),
));
