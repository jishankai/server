<h1>销售统计 - 详细充值记录</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('detail'), 'get', array('name' => 'index'));

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'startTime',
    'options'=>array(
        'showAnim'=>'fold',
        'showOn'=>"both",
        'buttonImage'=>Yii::app()->request->baseUrl."/admin/images/jqueryui/calendar.gif",
        'dateFormat' => 'yy-mm-dd',

    ),
    'value' => date('Y-m-d', $startTime),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),

));
?>
~
<?php 
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'endTime',
    'options'=>array(
        'showAnim'=>'fold',
        'showOn'=>"both",
        'buttonImage'=>Yii::app()->request->baseUrl."/admin/images/jqueryui/calendar.gif",
        'dateFormat' => 'yy-mm-dd',

    ),
    'value' => date('Y-m-d', $endTime),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),

));

echo CHtml::hiddenField('money', '0');
echo CHtml::submitButton('submit',array('id' => 'search', 'name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();
?>
<br>
<a id="money0" class="moneyType attachLoading z-button fr" href="#" <?php if($money == 0){?>style="color:red;"<?php }?>><?php echo Yii::t('adminStage', '美元');?></a>
<a id="money1" class="moneyType attachLoading z-button fr" href="#" <?php if($money == 1){?>style="color:red;"<?php }?>><?php echo Yii::t('adminStage', '人民币');?></a>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'detail',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'time', 
            'header' => '充值时间', 
            'value' => 'date("Y-m-d H:i:s", $data["time"])',
            'htmlOptions' => array(
                'style' => 'text-align: center;',
            ),
        ),
        array(
            'name' => 'name', 
            'header' => '玩家名称', 
            'value' => '$data["name"]',
        ),
        array(
            'name' => 'money',
            'header' => '充值金额',
            'value' => '$data["money"]',
        ),
        array(
            'name' => 'product',
            'header' => '所购商品',
            'value' => 'SalesController::getProductName($data["product"])',
        ),
    ),
));
?>

<script type="text/javascript">
$(document).ready(function(){
    $('.moneyType').click(function(){
        moneyId = this.id.slice(-1);
        $('#money').attr('value', moneyId);
        $('#search').click();
    })
})
</script>
