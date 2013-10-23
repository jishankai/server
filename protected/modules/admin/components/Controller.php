<?php
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
    public $layout='/layouts/column2';
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

    public function filters()
    {
        return array(
            'checkUser',
        );
    }

    public function filterCheckUser($filterChain) 
    {
        $session = Yii::app()->session;
        $session->open();
        $users=array(
            // username => password
            'demo'=>'demo',
            'admin'=>'admin',
            'su'=>'su',
        );

        $hostInfo = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? 'http://' . $_SERVER['HTTP_X_FORWARDED_HOST'] : Yii::app()->getRequest()->getHostInfo();
        $uri = Yii::app()->getRequest()->getRequestUri();
        if (array_key_exists(Yii::app()->user->name, $users)) {
            $filterChain->run();
            return true;
        } else if (preg_match("/admin\/site\/login/", $uri))
        {
            $filterChain->run();
            return true;
        } else {
            $this->redirect($this->createUrl('site/login'));
            return false;
        }

        $filterChain->run();
    }
    
    protected function echoJsonData($data=array()) 
    {
        $response = Yii::app()->getResponse();
        $response->setData($data);
        $response->render();
    }
}
