<h1>用户统计 - 机种分布</h1>
<br>
<p>按设备类型</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'terminal',
	'dataProvider' => $terminalDataProvider,
	'columns' => array(
		array('name' => 'terminal', 'header' => '机种', 'value' => '$data["terminal"]'),
		array('name' => 'terminalNum', 'header' => '数量', 'value' => '$data["terminalNum"]'),
		array('name' => 'terminalPercent', 'header' => '占比', 'value' => 'UserSummary::model()->getTerminalPercent($data, '.$terminalCount.')'),
	),
));
?>
<p>按os版本</p>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'os',
	'dataProvider' => $osDataProvider,
	'columns' => array(
		array('name' => 'os', 'header' => '机种', 'value' => '$data["os"]'),
		array('name' => 'osNum', 'header' => '数量', 'value' => '$data["osNum"]'),
		array('name' => 'osPercent', 'header' => '占比', 'value' => 'UserSummary::model()->getOsPercent($data, '.$osCount.')'),
	),
));
?>
<p>混合</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'mix',
	'dataProvider' => $mixDataProvider,
	'columns' => array(
		array('name' => 'mix', 'header' => '机种', 'value' => 'UserSummary::model()->getMixName($data)'),
		array('name' => 'mixNum', 'header' => '数量', 'value' => '$data["mixNum"]'),
		array('name' => 'mixPercent', 'header' => '占比', 'value' => 'UserSummary::model()->getMixPercent($data, '.$mixCount.')'),
	),
));
