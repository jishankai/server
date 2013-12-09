<?php
define('SIGKEY', 'tcat');
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout='//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();

    public $playerId;

    public function filterCheckUpdate($filterChain)
    {
        /*
        $ver = $_REQUEST['ver'];
        if ($ver < VERSION) {
            $this->response->setClientOutdated();//重新登录
            $this->response->render();
        } else {
            $filterChain->run();
        }
         */
        $filterChain->run();
            
    }

    public function filterGetPlayerId($filterChain)
    {
        if (isset($_REQUEST['SID']) && $_REQUEST['SID']=='') unset($_REQUEST['SID']); 
        $session = Yii::app()->session;
        $session->open();
        if (empty($session['playerId'])) {
            $this->response->setExpired();//重新登录
            $this->response->render();
        } else {
            $this->playerId = $session['playerId'];
            $filterChain->run(); 
        }
    }

    public function filterCheckSig($filterChain)
    {
        if (!CHECK_SIG_FLAG or $this->checkSig()) {
            $filterChain->run();
        } else {
            throw new CException('Signature Error');
        }
    }

    public function signature($params) 
    {
        if (array_key_exists('sig', $params)) unset($params['sig']);
        if (array_key_exists('r', $params)) unset($params['r']); 

        ksort($params);
        $newArray = array();
        foreach ($params as $key => $val) {
            $newArray[] = $key. '=' . $val;
        }
        $string = implode('&', $newArray);
        return md5($string . SIGKEY);
    }

    public function checkSig()
    {
        $params = $this->getActionParams();
        if (array_key_exists('sig', $params)) return $params['sig'] == $this->signature($params);
    }

    /**
     * Returns the reqeust parameters that will be used for action parameter binding. Include $_GET and $_POST.
     * @return array the request parameters to be used for action parameter binding.
     */
    public function getActionParams()
    {
        return $_GET + $_POST;
    }

    public function getResponse()
    {
        return Yii::app()->getResponse(); 
    }
	
    protected function echoJsonData($data=array()) 
    {
        $this->response->setData($data);
        $this->response->render();
    }
}
