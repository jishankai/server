<h1>用户统计 - 用户详细</h1>
<br>
<div id="SecuredActionBarForSearchAndListView" class="ActionBarForSearchAndListView ConfigurableMetadataView MetadataView">
<div class="view-toolbar-container clearfix">
<div class="view-toolbar">
<?php $this->renderPartial("menu",array("player"=>$player)); ?>
</div>
</div>
</div>
<div class="CGridViewContainer" style="width:1600px; overflow: auto;">
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider' => $dataProvider,
	'columns' => array(
		array(
			'name' => 'time',
			'header' => '时间',
			'value' => 'date("Y-m-d H:i:s", $data["time"])',
			'htmlOptions' => array(
				'style' => 'text-align: center;',
			),
		),
		array(
		   'name' => 'opponentId',
		   'header' => '对手ID',
		   'value' => '$data["opponentId"]',
		),
		array(
            'class' => 'CLinkColumn',
		  'header' => 'opponentName',
		  'header' => '对手名称',
		  'labelExpression' => '$data["opponentName"]',
          'urlExpression' => 'Yii::app()->createUrl("admin/player/detail", array("playerId" => $data["opponentId"]))',
		'htmlOptions' => array(
				'style' => 'text-decoration: underline;',
			),
		),
		array(
			'name' => 'sr1_atk',
			'header' => 'R1_己攻',
			'value' => 'isset($data["sr1_atk"])?$data["sr1_atk"]:NULL',
		),
		array(
			'name' => 'sr1_def',
			'header' => 'R1_己防',
			'value' => 'isset($data["sr1_def"])?$data["sr1_def"]:NULL'
        ),
        	array(
			'name' => 'sr1_combo',
			'header' => 'R1_己连击',
			'value' => 'isset($data["sr1_combo"])?$data["sr1_combo"]:NULL'
        ),
        	array(
			'name' => 'sr1_hp',
			'header' => 'R1_己血',
			'value' => 'isset($data["sr1_hp"])?$data["sr1_hp"]:NULL'
        ),
        	array(
			'name' => 'or1_atk',
			'header' => 'R1_敌攻',
			'value' => 'isset($data["or1_atk"])?$data["or1_atk"]:NULL',
		),
		array(
			'name' => 'or1_def',
			'header' => 'R1_敌防',
			'value' => 'isset($data["or1_def"])?$data["or1_def"]:NULL'
        ),
        	array(
			'name' => 'or1_combo',
			'header' => 'R1_敌连击',
			'value' => 'isset($data["or1_combo"])?$data["or1_combo"]:NULL'
        ),
        	array(
			'name' => 'or1_hp',
			'header' => 'R1_敌血',
			'value' => 'isset($data["or1_hp"])?$data["or1_hp"]:NULL'
        ),
        array(
			'name' => 'sr2_atk',
			'header' => 'R2_己攻',
			'value' => 'isset($data["sr2_atk"])?$data["sr2_atk"]:NULL',
		),
		array(
			'name' => 'sr2_def',
			'header' => 'R2_己防',
			'value' => 'isset($data["sr2_def"])?$data["sr2_def"]:NULL'
        ),
        	array(
			'name' => 'sr2_combo',
			'header' => 'R2_己连击',
			'value' => 'isset($data["sr2_combo"])?$data["sr2_combo"]:NULL'
        ),
        	array(
			'name' => 'sr2_hp',
			'header' => 'R2_己血',
			'value' => 'isset($data["sr2_hp"])?$data["sr2_hp"]:NULL'
        ),
        	array(
			'name' => 'or2_atk',
			'header' => 'R2_敌攻',
			'value' => 'isset($data["or2_atk"])?$data["or2_atk"]:NULL',
		),
		array(
			'name' => 'or2_def',
			'header' => 'R2_敌防',
			'value' => 'isset($data["or2_def"])?$data["or2_def"]:NULL'
        ),
        	array(
			'name' => 'or2_combo',
			'header' => 'R2_敌连击',
			'value' => 'isset($data["or2_combo"])?$data["or2_combo"]:NULL'
        ),
        	array(
			'name' => 'or2_hp',
			'header' => 'R2_敌血',
			'value' => 'isset($data["or2_hp"])?$data["or2_hp"]:NULL'
		),
		array(
			'name' => 'result',
			'header' => '胜负',
			'value' => '$data["result"]',
		),
        array(
			'name' => 'score',
			'header' => '积分变化',
			'value' => '$data["score"]',
        ),
        array(
			'name' => 'rank',
			'header' => '排名变化',
			'value' => '$data["rank"]',
		),
	),
));
?>
</div>
