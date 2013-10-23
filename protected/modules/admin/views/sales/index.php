<h1>销售统计 - 总览</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('index'), 'get', array('name' => 'index'));

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
?>
&nbsp&nbsp&nbsp&nbsp&nbsp
<?php
echo CHtml::label("分成系数", 'rate');
echo CHtml::textField("rate", "0.7", array('class'=>'rate'));
echo CHtml::hiddenField('money', '0');
echo CHtml::submitButton('submit',array('id' => 'search', 'name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();
?>

<br>
<a id="money0" class="moneyType attachLoading z-button fr" href="#" <?php if($money == 0){?>style="color:red;"<?php }?>><?php echo Yii::t('adminStage', '美元');?></a>
<a id="money1" class="moneyType attachLoading z-button fr" href="#" <?php if($money == 1){?>style="color:red;"<?php }?>><?php echo Yii::t('adminStage', '人民币');?></a>
<?php
if($money == 0){
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'date',
		'dataProvider' => $dataProvider,
		'columns' => array(
            array(
                'name' => 'date', 
                'header' => '日期', 
                'footer' => '总计',
                'value' => 'date("Y-m-d", $data["date"])."(".$data["week"]."周 ".$data["month"]."月)"',
			    'htmlOptions' => array(
				    'style' => 'text-align: center;',
			    ),
            ),
			
            array(
                'name' => 'searchDollar', 
                'header' => '销售额', 
                'value' => '$data["searchDollar"]',
                'footer' => $sum['dollar'],
            ),
			//显示美元
			array(
				'name' => 'myDollar',
				'header' => '分成后销售额',
				'id' => '123',
                'value' => '$data["myDollar"]',
                'footer' => $sum['myDollar'],
			),
			array(
				'name' => 'week',
				'header' => '周别累计',
				'value' => $this->gridWeekSummary('$data["weekSummaryUS"]').".'/'.".$this->gridWeekSummary('$data["weekMyUS"]'),
			),
			array(
				'name' => 'month',
				'header' => '月别累计',
				'value' => $this->gridMonthSummary('$data["monthSummaryUS"]').".'/'.".$this->gridMonthSummary('$data["monthMyUS"]'),
			),
        ),
	));
}else{
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'index',
		'dataProvider' => $dataProvider,
		'columns' => array(
            array(
                'name' => 'date', 
                'header' => '日期', 
                'footer' => '总计',
                'value' => 'date("Y-m-d", $data["date"])',
			    'htmlOptions' => array(
				    'style' => 'text-align: center;',
			    ),
            ),
			
            array(
                'name' => 'searchDollar', 
                'header' => '销售额', 
                'value' => '$data["searchRMB"]',
                'footer' => $sum['rmb'],
            ),
			array(
				'name' => 'myRMB',
				'header' => '分成后销售额',
				'id' => '123',
                'value' => '$data["myRMB"]',
                'footer' => $sum['myRMB'],
			),
			array(
				'name' => 'week',
				'header' => '周别累计',
				'value' => $this->gridWeekSummary('$data["weekSummaryRMB"]').".'/'.".$this->gridWeekSummary('$data["weekMyRMB"]'),
			),
			array(
				'name' => 'month',
				'header' => '月别累计',
				'value' => $this->gridMonthSummary('$data["monthSummaryRMB"]').".'/'.".$this->gridMonthSummary('$data["monthMyRMB"]'),
			),
		),
	));
}
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

