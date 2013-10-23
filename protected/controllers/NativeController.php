<?php

class NativeController extends Controller
{
    public function filters()
    {
        return array(
            'checkUpdate',
            'checkSig',
        );    
    } 

    /*
    public function actionCheckResources(){
        $data=AppFile::appFileMD5();
        $this->renderPartial('checkresources',array(
            'message' => $data,
        ));
    }

    public function actionCheckUpdate(){
        $fileInfo = AppFile::allFileList();
        $this->renderPartial('checkupdate', array(
            'message' => $fileInfo[1],
        ));
    }
     */
    public function actionCheckMd5()
    {
        $this->echoJsonData(Util::loadConfig('resource_md5'));
    }

    public function actionCheckResourceList()
    {
        $this->echoJsonData(Util::loadConfig('resource_list'));
    }
    
    public function actionInviterRewards()
    {
        $this->echoJsonData(Util::loadConfig('inviterRewards'));
    }
}

