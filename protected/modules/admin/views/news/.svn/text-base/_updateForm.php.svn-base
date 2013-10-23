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
		<?php echo $form->labelEx($model,'日文内容'); ?>
		<?php echo $form->textArea($model,'content_jp',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content_jp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'英文标题'); ?>
		<?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'英文内容'); ?>
		<?php echo $form->textArea($model,'content_en',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content_en'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'中文标题'); ?>
		<?php echo $form->textField($model,'title_zh',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title_zh'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'中文内容'); ?>
		<?php echo $form->textArea($model,'content_zh',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content_zh'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'开始时间'); ?>
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
                <?php echo $form->textField($model,'startTime',array('value'=>date('H:i:s',$date)));?>
            <?php  //echo $form->textField($model,'startTime',array('value'=>date('H:m:s',$start)))?>
		<?php echo $form->error($model,'startTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'结束时间'); ?>
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
                <?php echo $form->textField($model,'endTime',array('value'=>date('H:i:s',$date)));?>
            <?php  //echo $form->textField($model,'startTime',array('value'=>date('H:m:s',$start)))?>
		<?php echo $form->error($model,'endTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'是否置顶'); ?>
		<?php echo $form->dropDownList($model,'isTop',array('1'=>'是','0'=>'否')); ?>
		<?php echo $form->error($model,'isTop'); ?>
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

