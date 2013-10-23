<?php
$this->breadcrumbs=array(
	'Notice',
);

$this->menu=array(
	array('label'=>'创建推送', 'url'=>array('create')),
	array('label'=>'管理推送', 'url'=>array('admin')),
);
?>

<h1>Notice</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
