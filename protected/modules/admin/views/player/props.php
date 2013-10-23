<h1>用户统计 - 用户详细</h1>
<br>
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<?php $this->renderPartial("menu",array("player"=>$player)); ?>
</div>
</div>
</div>

<?php
echo CHtml::beginForm($this->createUrl('props', array('playerId'=>$player->playerId)), 'POST', array('name' => 'props'));

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
	'dataProvider' => $dataProvider,
	'columns' => array(
		array(
			'name' => 'createTime',
			'header' => '变更日期',
			'value' => 'date("Y-m-d H:i:s", $data["createTime"])',
			'htmlOptions' => array(
				'style' => 'text-align: center;',
			),
		),
		array(
		   'name' => 'type',
		   'header' => '道具类别',
		   'value' => 'PlayerSummary::model()->getPropsType($data["propsId"])',
		),
		array(
		  'name' => 'name',
		  'header' => '道具内容',
		  'value' => 'PlayerSummary::model()->getPropsName($data["propsId"])',
		),
		array(
			'name' => 'num',
			'header' => '变更数量',
			'value' => '$data["num"]',
		),
		array(
			'name' => 'operate',
			'header' => '变更原因',
			'value' => 'PlayerSummary::model()->getPropsOperate($data["operate"])',
		),
	),
));
