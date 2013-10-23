<?php
/*$this->breadcrumbs=array(
	'Notices'=>array('index'),
	$model->title=>array('view','id'=>$model->noticeId),
	'Update',
);*/

$this->menu=array(
	//array('label'=>'公告列表', 'url'=>array('index')),
	array('label'=>'创建公告', 'url'=>array('create')),
	array('label'=>'查看公告', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理公告', 'url'=>array('admin')),
);
?>

<h1>更新公告</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
