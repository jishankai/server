<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        //$this->render('index');
        $this->redirect(array('player/index'));
    }

    public function actionStatistics()
    {
        $this->layout = '/layouts/column1';
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $headers="From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->layout='/layouts/columnLogin';
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect($this->createUrl('site/index'));
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();

        $this->redirect($this->createUrl('site/login'));
    }

    public function actionImport()
    {
        if(isset($_FILES['batchFile']) && $_FILES['batchFile']['error']==0)
        {//导入数据。
            Yii::import('ext.phpexcel.XPHPExcel');      
            $objPHPExcel = XPHPExcel::readPHPExcel($_FILES['batchFile']['tmp_name']);

            $sheet = $objPHPExcel->getSheet(0);   //获取excel中sheet(0)的数据
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $arr=array();
            $arr_column=array();
            for($j=2;$j<=$highestRow;$j++)
            {
                for($k='B';$k<= $highestColumn;$k++)
                {
                    //读取单元格
                    $arr_column[] = $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                }
                $arr[$objPHPExcel->getActiveSheet()->getCell("A$j")->getValue()] = $arr_column;
            }
            if(isset($arr))
            {
                $this->echoJsonData($arr);
            } else {  
                Yii::app()->user->setFlash('commentSubmitted ','导入数据失败，请查看你的文件是否按要求配置！');
                $this->redirect(Yii::app()->request->url);
            }

        }
        $this->render('import');
    }
}
