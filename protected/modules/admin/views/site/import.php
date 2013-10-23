<h1>文件导入</h1>
<br>
<?php $form=$this->beginWidget('CActiveForm', array(

    'id'=>'datalist-form',

    'htmlOptions'=>array('enctype'=>'multipart/form-data'),  

    'enableClientValidation'=>true,

    'clientOptions'=>array(

        'validateOnSubmit'=>true,

    ),

)); ?>

<div class="control-group" >

       <p align="center">

       <input type="file" name="batchFile" value="" />

       <input type="submit" value="导入数据" />

     <span class="flash-success"><?php if(Yii::app()->user->hasFlash('commentSubmitted '))?>

               <?php echo Yii::app()->user->getFlash('commentSbmitted '); ?></span></p>

<?php $this->endWidget(); ?>
