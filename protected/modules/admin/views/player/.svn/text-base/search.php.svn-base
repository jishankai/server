<h1>用户统计 - 玩家检索</h1>
<br>
<?php
echo CHtml::beginForm($this->createUrl('search'), 'get', array('name' => 'search', 'class' => 'attachLoading'));

echo CHtml::label('用户ID', 'playerId');
echo CHtml::textField('playerId', $find['playerId']);
echo '<br><br>';

echo CHtml::label('用户名', 'name');
echo CHtml::textField('name', $find['name']);
echo '<br><br>';

echo CHtml::label('招待ID', 'inviteCode');
echo CHtml::textField('inviteCode', $find['inviteCode']);
echo '<br><br>';

echo CHtml::label('积分区间: ', 'score');
echo CHtml::textField('lowScore', $find['lowScore']);
echo '~';
echo CHtml::textField('highScore', $find['highScore']);
echo '<br><br>';

echo CHtml::label('排名区间: ', 'rank');
echo CHtml::textField('lowRank', $find['lowRank']);
echo '~';
echo CHtml::textField('highRank', $find['highRank']);
echo '<br><br>';

echo CHtml::submitButton('submit',array('name' => 'search', 'value' => '检索', 'class' => 'attachLoading z-button'));
echo CHtml::endForm();
?>
<br><br>
<p>总共找到<?php echo count($player);?>个符合条件的用户</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'u.playerId',
	'dataProvider' => $playerDataProvider,
	'columns' => array(
        array('name' => 'playerId', 'header' => '玩家ID', 'value' => '$data["playerId"]'),
		array(
			'class' => 'CLinkColumn',
			'header' => '用户名',
			'labelExpression' => '$data["name"]',
			'urlExpression' => 'Yii::app()->createUrl("admin/player/detail", array("playerId" => $data["playerId"]))',
			'htmlOptions' => array(
				'style' => 'text-decoration: underline;',
			),
		),
		array('name' => 'inviteCode', 'header' => '招待ID', 'value' => '$data["inviteCode"]'),
		array('name' => 'score', 'header' => '积分', 'value' => '$data["score"]/100'),
		array('name' => 'rank', 'header' => '排名', 'value' => '$data["rank"]'),
		array(
			'name' => 'createTime', 
			'header' => '注册时间', 
			'value' => 'date("Y-m-d H:i:s", $data["createTime"])',
			'htmlOptions' => array(
				'style' => 'text-align: center;',
			),
		),
		array(
			'name' => 'lastLoginTime', 
			'header' => '最后登录时间', 
			'value' => 'date("Y-m-d H:i:s", $data["loginTime"])',
			'htmlOptions' => array(
				'style' => 'text-align: center;',
			),
		),
	),
));
