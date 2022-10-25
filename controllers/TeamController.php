<?php
namespace app\controllers;
use Yii;
use app\models\Team;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class TeamController extends Controller{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                       
                    ],
                ],
            ]
        );
    }


    public function actionIndex()
    {
             $dataProvider = new ActiveDataProvider([
                'query' =>Team::find()->creator(Yii::$app->user->id),
            ]);
            
             return $this->render('index', [
             'dataProvider' => $dataProvider
             ]);
  
} 

}