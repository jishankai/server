<?php
/*$this->breadcrumbs=array(
	'News'=>array('admin'),
	$model->title_zh,
);*/

$this->menu=array(
	//array('label'=>'公告列表', 'url'=>array('index')),
	array('label'=>'创建公告', 'url'=>array('create')),
	array('label'=>'更新公告', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除公告', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理公告', 'url'=>array('admin')),
);
?>

<h1>查看公告</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'title_jp',
		'content_jp',
		'title_en',
		'content_en',
		'title_zh',
		'content_zh',
                array('name'=>'startTime','value'=>date("Y-m-d H:i:s",$model->startTime)),
                array('name'=>'endTime','value'=>date("Y-m-d H:i:s",$model->endTime)),
		'isTop',
		//'createTime',
		//'updateTime',
	),
)); ?>
