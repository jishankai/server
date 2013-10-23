<?php
/*$this->breadcrumbs=array(
	'Notices'=>array('index'),
	$model->title=>array('view','id'=>$model->noticeId),
	'Update',
);*/

$this->menu=array(
	//array('label'=>'推送列表', 'url'=>array('index')),
	array('label'=>'创建推送', 'url'=>array('create')),
	array('label'=>'查看推送', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理推送', 'url'=>array('admin')),
);
?>

<h1>更新推送</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
