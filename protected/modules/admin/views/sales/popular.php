<style type="text/css">
.red{background:#FFC0CB;}
.green{background:#B4EEB4;}
</style>

<h1>销售统计 - 热卖商品</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('popular'), 'get', array('name' => 'index'));

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

echo CHtml::hiddenField('type', '0');
echo CHtml::submitButton('submit',array('id' => 'search', 'name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();
?>

<br>
<!--<a id="type1" class="contentType attachLoading z-button fr" href="#" <?php if($type == 1){?>style="color:red"<?php }?>>使用数量</a>
<a id="type0" class="contentType attachLoading z-button fr" href="#" <?php if($type == 0){?>style="color:red"<?php }?>>出售数量</a>-->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'popular',
	'dataProvider' => $dataProvider,
	'columns' => array(
		array(
			'name' => 'date',
			'header' => '日期',
			'value' => 'date("Y-m-d", $data["date"])',
            'footer' => '总计',
			'htmlOptions' => array(
				'style' => 'text-align: center;',
			),
		),
		array(
		   'name' => 'cp_1',
		   'header' => '药水1瓶装',
		   'value' => 'PlayerSummary::model()->getCompareByKey($data, "cp_1")',
           'footer' => $sum['cp_1'],
		   'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "cp_1")',
		),
		array(
		  'name' => 'cp_6',
		  'header' => '药水6瓶装',
		  'value' => 'PlayerSummary::model()->getCompareByKey($data, "cp_6")',
          'footer' => $sum['cp_6'],
		  'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "cp_6")',
		),
		array(
			'name' => 'cp_12',
			'header' => '药水12瓶装',
            'value' => 'PlayerSummary::model()->getCompareByKey($data, "cp_12")',
            'footer' => $sum['cp_12'],
		    'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "cp_12")',
		),
		array(
			'name' => 'line',
			'header' => '瞄准线包',
            'value' => 'PlayerSummary::model()->getCompareByKey($data, "line")',
            'footer' => $sum['line'],
		    'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "line")',
		),
        array(
			'name' => 'stone',
			'header' => '融石药水包',
            'value' => 'PlayerSummary::model()->getCompareByKey($data, "stone")',
            'footer' => $sum['stone'],
		    'cssClassExpression' => 'PlayerSummary::model()->getBackgroundByKey($data, "stone")',
		),
	),
));
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.contentType').click(function(){
		typeId = this.id.slice(-1);
		$('#type').attr('value', typeId);
		$('#search').click();
	})
})
</script>
