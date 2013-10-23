<?php
/*$this->breadcrumbs=array(
	'Notice'=>array('admin'),
	$model->title_zh,
);*/

$this->menu=array(
	//array('label'=>'推送列表', 'url'=>array('index')),
	array('label'=>'创建推送', 'url'=>array('create')),
	array('label'=>'更新推送', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除推送', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理推送', 'url'=>array('admin')),
);
?>

<h1>查看推送</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'content',
        array('name'=>'time','value'=>date("Y-m-d H:i:s",$model->time)),
		//'createTime',
		//'updateTime',
	),
)); ?>
