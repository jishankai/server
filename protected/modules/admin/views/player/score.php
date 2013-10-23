<h1>用户统计 - 积分分布</h1>
<br>
<p>注: 这里的"活跃用户"是指最近7天登录过游戏的用户</p>
<p>注2：积分段均为前闭后开</p>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'score',
	'dataProvider' => $dataProvider,
	'columns' => array(
        array('name' => 'score', 'header' => '积分段', 'value' => '$data["score"]'),
		array('name' => 'scoreNum', 'header' => '用户数', 'value' => '$data["scoreNum"]'),
		array('name' => 'activeNum', 'header' => '活跃用户', 'value' => '$data["activeNum"]'),
		array('name' => 'activeNumPercent', 'header' => '活跃用户比', 'value' => 'PlayerSummary::model()->getActivePlayerPercent($data)'),
		array('name' => 'unActiveNum', 'header' => '流失用户', 'value' => '$data["unActiveNum"]'),
		array('name' => 'unActiveNumPercent', 'header' => '流失用户比', 'value' => 'PlayerSummary::model()->getUnActivePlayerPercent($data)'),
	),
));
