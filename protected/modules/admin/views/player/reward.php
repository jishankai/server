<h1>管理 - 奖励发放</h1>
<br>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reward-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'playerName'); ?>
		<?php echo $form->textField($model,'playerName'); ?>
		<?php echo $form->error($model,'playerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'props'); ?>
		<?php echo $form->textField($model,'props'); ?>
		<?php echo $form->error($model,'props'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textField($model,'desc', array('value'=>'管理员赠送')); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

	<div class="row buttons">
        <?php echo CHtml::ajaxSubmitButton('提交', array('player/reward'), array(
            "class" => "attachLoading z-button",
            "type" => "POST",
            "success" => "js:function(data){
                if (data==='success') {
                    alert('发送成功');
                } else {
                    alert('发送失败');
                }
            }"
        )); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
