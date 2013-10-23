<?php
class SendNoticeCommand extends CConsoleCommand {
	
	private function usage() {
		echo "Usage: SendNotice start [number]\n";
	}
	
	public function start($args) {
		$ret = CronLock::lock('SendNotice');
		if ($ret === 0) return;
		$breakPoint = 9999;
		if (isset($args[1])) {
			if (preg_match("/^[0-9]+$/", $args[1])) {
				$breakPoint = $args[1];
			}else{
				print "The args[1] must be a unsigned integer!!\n";
				return ;
			}
		}
		try {
			Notice::SendNotice($breakPoint);
		}
		catch(CException $e) {
			echo $e->getMessage();
		}
		CronLock::unlock('SendNotice');
	}
	
	public function run($args) {
        if(isset($args[0]) && $args[0] == 'start'){
            $this->start($args);
        }else{
            return $this->usage();
        }
    }
}
