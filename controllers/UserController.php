<?php
namespace app\controllers;
use yii\web\controller;

class HelloController extends Controller{
    public function actionSpeak()
    {
        //$user=SiteController::find();
            $dataProvider = new ActiveDataProvider([
                'query' => $user->getname(), 
            ]);
            return $this->render('speak', [
             'dataProvider' => $dataProvider,
            ]);
  
} 


}