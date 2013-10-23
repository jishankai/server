<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<!--<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->label($model,'标题（日文）'); ?>
		<?php echo $form->textField($model,'title_jp',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'内容（日文）'); ?>
		<?php echo $form->textArea($model,'content_jp',array('rows'=>6, 'cols'=>50)); ?>
    </div>
	<div class="row">
		<?php echo $form->label($model,'标题（英文）'); ?>
		<?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'内容（英文）'); ?>
		<?php echo $form->textArea($model,'content_en',array('rows'=>6, 'cols'=>50)); ?>
	</div>
    <div class="row">
		<?php echo $form->label($model,'标题（中文）'); ?>
		<?php echo $form->textField($model,'title_zh',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'内容（中文）'); ?>
		<?php echo $form->textArea($model,'content_zh',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'开始时间'); ?>
		<?php echo $form->textField($model, 'startTime'); ?>
	</div>
    <div class="row">
		<?php echo $form->label($model,'结束时间'); ?>
		<?php echo $form->textField($model, 'endTime'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'是否置顶'); ?>
		<?php echo $form->textField($model,'isTop'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->label($model,'createTime'); ?>
		<?php echo $form->textField($model,'createTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updateTime'); ?>
		<?php echo $form->textField($model,'updateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

