<?php

class MException extends CException
{
    
    /**
     * 
     */
    public function __construct($message, $data=NULL)
    {
        $this->message = $message;
        Yii::app()->controller->response->setData($data);
    }
}
