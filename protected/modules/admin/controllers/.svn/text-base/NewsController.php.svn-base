<?php

class NewsController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

	public function accessRules()
	{
        return array(
        );
	}

	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('News');
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

    public function actionAdmin()
    {
        $model = new News('search');
        $model->unsetAttributes();  // clear any default values

        if(isset($_GET['News'])) {
            $model->attributes=$_GET['News'];
        }

        $this->render('admin', array('model'=>$model));
    }

	public function actionView($id)
	{
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}
        
    public function actionCreate()
    {
        $model = new News;
        if(isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            //此处甚怪，只好单独赋值
            $model->content_jp = $_POST['News']['content_jp'];
            $model->content_en = $_POST['News']['content_en'];
            $model->content_zh = $_POST['News']['content_zh'];

            $startTime = $_POST['News']['startTime'];
            $endTime = $_POST['News']['endTime'];

            if(!empty($startTime)) {
                $model->startTime = strtotime("$startTime");
            }
            if(!empty($endTime)) {
                if ($endTime < $startTime) {
                    $endTime = $startTime;
                }
                $model->endTime = strtotime("$endTime");
            }

            $model->createTime = time();

            if($model->save()) {
                $this->redirect(array('view', 'id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['News']))
        {
            $model->attributes = $_POST['News'];
            //此处甚怪，只好单独赋值
            $model->content_jp = $_POST['News']['content_jp'];
            $model->content_en = $_POST['News']['content_en'];
            $model->content_zh = $_POST['News']['content_zh'];

            $startTime = $_POST['News']['startTime'];
            $endTime = $_POST['News']['endTime'];

            if(!empty($startTime)) {
                $model->startTime = strtotime("$startTime");
            }
            if(!empty($endTime)) {
                $model->endTime = strtotime("$endTime");
            }

            if($model->save()) {
                $this->redirect(array('view', 'id'=>$model->id));
            }
        }               

        $this->render('update',array(
            'model'=>$model,
        ));	
    }


    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        }

        else {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

    public function loadModel($id)
	{
		$model = News::model()->findByPk($id);
		if($model === NULL) {
            throw new CHttpException(404,'The requested page does not exist.');
        }

		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='notice-form')	{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
