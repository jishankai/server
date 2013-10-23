<?php
$this->breadcrumbs=array(
	'News',
);

$this->menu=array(
	array('label'=>'创建公告', 'url'=>array('create')),
	array('label'=>'管理公告', 'url'=>array('admin')),
);
?>

<h1>News</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
