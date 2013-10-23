<?php
/**
 * MaintenanceController class file.
 * @author Qi Changhai <qi.changhai@adways.net>
 */
/**
 * MaintenanceController process request duration server maintenance.
 * @author Qi Changhai <qi.changhai@adways.net>
 */
class MaintenanceController extends Controller
{
    function actionIndex()
    {
        $response = Yii::app()->getResponse();
        $response->setMaintenance();
        $response->render();
    }
}
