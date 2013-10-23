<?php
class FeedbackCommand extends CConsoleCommand {
	
	private function usage() {
		echo "Usage: Feedback start\n";
	}
	
	private function start() {
        try {
            $feedbacks = APNS::getFeedback(APPLE_NOTIFICATION_SANDBOX, 0);
            $tokens = array();
            foreach ($feedbacks as $item) {
                $tokens[] = "'" . $item['deviceToken'] . "'";
            }
            $tokenString = join($tokens, ',');
    		if (0 != strlen($tokenString)) {
    			$sql = "update device set token='' where token in ($tokenString)";
    			$command = Yii::app()->db->createCommand($sql);
    			$result = $command->execute();
    		}
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
		return 1;
	}
	
	public function run($args) {
        if(isset($args[0]) && $args[0] == 'start'){
            $this->start();
        }else{
            return $this->usage();
        }
    }
}
