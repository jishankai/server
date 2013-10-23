<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notice-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'日文标题'); ?>
		<?php echo $form->textField($model,'title_jp',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title_jp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'英文标题'); ?>
		<?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'中文标题'); ?>
		<?php echo $form->textField($model,'title_zh',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title_zh'); ?>
	</div>

	<div class="row">
	<?php echo $form->labelEx($model,'日文内容'); ?>
	    <textarea id="content_jp" name="News[content_jp]"  rows="12" cols="80" style="width: 60%"><?php echo $model->content_jp;?></textarea>
	<?php echo $form->error($model,'content_jp'); ?>
    </div>
       
	<div class="row">
	<?php echo $form->labelEx($model,'英文内容'); ?>
	    <textarea id="content_en" name="News[content_en]"  rows="12" cols="80" style="width: 60%"><?php echo $model->content_en;?></textarea>
	<?php echo $form->error($model,'content_en'); ?>
    </div>
       
	<div class="row">
	<?php echo $form->labelEx($model,'中文内容'); ?>
	    <textarea id="content_zh" name="News[content_zh]"  rows="12" cols="80" style="width: 60%"><?php echo $model->content_zh;?></textarea>
	<?php echo $form->error($model,'content_zh'); ?>
    </div>
       
	<div class="row">
		<?php echo $form->labelEx($model,'开始时间'); ?>
		<?php $this->widget('application.extensions.timepicker.timepicker', array(
                   'options'=>array(
                   'showSecond'=>TRUE
                    ),
                   'model'=>$model,
                   'name'=>'startTime',		  		
		 )); ?>     
		<?php echo $form->error($model,'startTime'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'结束时间'); ?>
		<?php $this->widget('application.extensions.timepicker.timepicker', array(
                   'options'=>array(
                   'showSecond'=>TRUE
                    ),
                   'model'=>$model,
                   'name'=>'endTime',		  		
		 )); ?>     
		<?php echo $form->error($model,'endTime'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'是否置顶'); ?>
		<?php echo $form->dropDownList($model,'isTop', array('1'=>'是','0'=>'否')); ?>
		<?php echo $form->error($model,'isTop'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("class"=>"attachLoading z-button")); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
