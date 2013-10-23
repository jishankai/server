<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<?php
            $usernameLabel      = $form->label        ($model, 'username');
            $usernameTextField  = $form->textField    ($model, 'username');
            $usernameError      = $form->error        ($model, 'username');
            $passwordLabel      = $form->label        ($model, 'password');
            $passwordField      = $form->passwordField($model, 'password');
            $passwordError      = $form->error        ($model, 'password');
            $rememberMeCheckBox = $form->checkBox     ($model, 'rememberMe');
            $rememberMeLabel    = $form->label        ($model, 'rememberMe');
            $rememberMeError    = $form->error        ($model, 'rememberMe');
			$content="<div>$usernameLabel$usernameTextField$usernameError</div>"  .
                       "<div>$passwordLabel$passwordField$passwordError</div>";
                 
         echo $content;
?>



<div class="row buttons">
	<?php echo CHtml::submitButton('Login',array('class'=>"attachLoading z-button","id"=>"login")); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
