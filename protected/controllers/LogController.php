<?php
class LogController extends Controller {
	public function actionUpdateLog() {
		if(isset($_POST['uid']) && isset($_POST['log'])) {
			$currentTime = time();
			$fileName = "bubblepvp_log_".$currentTime.".log";
			$path=Yii::app()->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . "log";
			if(!file_exists($path)) mkdir($path, 0777);
			$file = fopen($path . DIRECTORY_SEPARATOR . $fileName, 'w');
			$content = "uid:".$_POST['uid']."\n"."log:".$_POST['log'];
			//$content = $data;
			fwrite($file, $content);
			fclose($file);
			$this->echoJsonData();
		}
		else {
			throw new Exception("no post!");
		}
	}
}
