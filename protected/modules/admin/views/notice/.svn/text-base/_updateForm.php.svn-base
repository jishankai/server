<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notice-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'推送内容'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'推送时间'); ?>
		<?php $this->widget(
				'zii.widgets.jui.CJuiDatePicker',
				array(
					//'name'=>"ReportTable[date]",                                       
                                        'model'=>$model,   
                                        'attribute'=>'startDate',   
                                        'language'=> 'zh_cn',
					'options'=>array(
						'showAnim'=>'fold',
                                                'dateFormat' => 'yy-mm-dd',
                                                'changeYear'=>'true', 
                                               'changeMonth'=>'true',  
                                                'yearRange'=>'2000:2020'
                                            
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;',
                                                'readonly'=>true,
                                                'value'=>date('Y-m-d',$date),
					),
				)
	        );?>
                <?php echo $form->textField($model,'time',array('value'=>date('H:i:s',$date)));?>
            <?php  //echo $form->textField($model,'startTime',array('value'=>date('H:m:s',$start)))?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row" style="display: none">
		<?php echo $form->labelEx($model,'createTime'); ?>
		<?php echo $form->textField($model,'createTime',array('value'=>time())); ?>
		<?php echo $form->error($model,'createTime'); ?>
	</div>

	<div class="row" style="display: none">
		<?php echo $form->labelEx($model,'updateTime'); ?>
		<?php echo $form->textField($model,'updateTime'); ?>
		<?php echo $form->error($model,'updateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

