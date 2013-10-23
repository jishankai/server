<div class="view">

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />-->

	<b><?php echo CHtml::encode($data->getAttributeLabel('日文标题')); ?>:</b>
	<?php echo CHtml::encode($data->title_jp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('日文内容')); ?>:</b>
	<?php echo CHtml::encode($data->content_jp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('英文标题')); ?>:</b>
	<?php echo CHtml::encode($data->title_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('英文内容')); ?>:</b>
	<?php echo CHtml::encode($data->content_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('中文标题')); ?>:</b>
	<?php echo CHtml::encode($data->title_zh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('中文内容')); ?>:</b>
	<?php echo CHtml::encode($data->content_zh); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('开始时间')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s',$data->startTime)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('结束时间')); ?>:</b>
	<?php echo CHtml::encode(date('Y-m-d H:i:s',$data->endTime)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('是否置顶')); ?>:</b>
	<?php echo CHtml::encode($data->isTop); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('createTime')); ?>:</b>
	<?php echo CHtml::encode($data->createTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updateTime')); ?>:</b>
	<?php echo CHtml::encode($data->updateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleteFlag')); ?>:</b>
	<?php echo CHtml::encode($data->deleteFlag); ?>
	<br />

	*/ ?>

</div>
