<h1>用户统计 - 用户详细</h1>
<br>
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<?php $this->renderPartial("menu",array("player"=>$player)); ?>
</div>
</div>
</div>

<?php
echo CHtml::beginForm($this->createUrl('recharge', array('playerId'=>$player->playerId)), 'POST', array('name' => 'recharge'));

$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'dateFrom',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'showOn'=>"both",
		'buttonImage'=>Yii::app()->request->baseUrl."/admin/images/jqueryui/calendar.gif",
        'dateFormat' => 'yy-mm-dd',
		
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
	'value'=>date("Y-m-d",$dateFrom)
	
));
echo "~";
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'dateTo',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'showOn'=>"both",
	     'buttonImage'=>Yii::app()->request->baseUrl."/admin/images/jqueryui/calendar.gif",
        'dateFormat' => 'yy-mm-dd',
		
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
    'value'=>date("Y-m-d",$dateTo-1)
   
));

echo CHtml::submitButton('submit',array('name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();
?>

<a class="attachLoading z-button fr" href="<?php echo $this->createUrl("recharge",array("playerId"=>$player->playerId,'dateFrom'=>date("Y-m-d",$dateFrom),'dateTo'=>date("Y-m-d",$dateTo-1),'money'=>0));?>">美元</a>
<a class="attachLoading z-button fr" href="<?php echo $this->createUrl("recharge",array("playerId"=>$player->playerId,'dateFrom'=>date("Y-m-d",$dateFrom),'dateTo'=>date("Y-m-d",$dateTo-1),'money'=>1));?>">人民币</a>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(           
            'name'=>'充值时间',
            'value'=>'date("Y-m-d H:i:s",$data["createTime"])',
            'footer'=>'总计'
        ),
        array(           
            'name'=>'美元',
            'value'=>'$data["dollar"]',
            'footer'=>$dataSum["dollar"],
            'visible'=>isset($_GET['money'])&&$_GET['money']==1?false:true,
        ),
        array(           
            'name'=>'人民币',
            'value'=>'$data["rmb"]',
            'footer'=>$dataSum["rmb"],
            'visible'=>isset($_GET['money'])&&$_GET['money']==1?true:false,
        ),
        array(           
            'name'=>'所购道具',
            'value'=>'$data["props"]',
        ),
    )

));
?>
