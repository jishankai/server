<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notice-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php echo $form->labelEx($model,'推送内容'); ?>
	    <textarea id="content" name="Notice[content]"  rows="12" cols="80" style="width: 60%"><?php echo $model->content;?></textarea>
	<?php echo $form->error($model,'content'); ?>
    </div>
       
	<div class="row">
		<?php echo $form->labelEx($model,'推送时间'); ?>
		<?php $this->widget('application.extensions.timepicker.timepicker', array(
                   'options'=>array(
                   'showSecond'=>TRUE
                    ),
                   'model'=>$model,
                   'name'=>'time',		  		
		 )); ?>     
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("class"=>"attachLoading z-button")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
