<?php
class CronLock {
	public static function lock($name) {
        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cronLock' . DIRECTORY_SEPARATOR . $name;
		$currentPid = getmypid();

		if (file_exists($filename)){
			//print "File exists!\n";
			$fp = fopen($filename, 'r');
			$length = filesize($filename);

			if ($length) {
				$lastPid = fread($fp, $length);
				$shell = "ps -p ".$lastPid." -o cmd= | grep ".$name;
				$result = `$shell`;

				if ($result){
					//print "The process is running!\n";
					return 0;
				}else{
					//print "The process is not running!\n";
				}
			}else{
				//print "There is nothing in the file!\n";
			}
		}else{
			//print "File does not exist!\n";
		}

		$fp = fopen($filename, 'w');
		fwrite($fp, $currentPid);
		//print "Locked $name\n";
		fclose($fp);
		return 1;
	}

	public static function unlock($name) {
        $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cronLock' . DIRECTORY_SEPARATOR . $name;
		$currentPid = getmypid();

		if (!file_exists($filename)){
			//print "File does not exist!\n";
			return ;
		}

		$fp = fopen($filename, 'r');
		$length = filesize($filename);

		if (0 == $length) {
			//print "There is nothing in the file!\n";
			fclose($fp);
			unlink($filename);
			//print "Unlinked file!\n";
			return 0;
		}

		$lastPid = fread($fp, $length);

		if ($lastPid == $currentPid){
			fclose($fp);
			unlink($filename);
			//print "Unlinked file!\n";
			return 0;
		}

		print "Error!\n";
	}
}
?>
