<?php

namespace app\controllers;

use Yii;
use app\models\Admin;
use yii\base\InvalidParamException;   
use yii\web\BadRequestHttpException;    
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\InfoForm;
use app\models\SignupForm;
use app\models\ActionForm;
use app\models\ActionAdmin;




class AdminController extends Controller
{

    
public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'only' => ['logout'],
            'rules' => [
                [
                    'actions' => ['logout'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'logout' => ['post'],
            ],
        ],
    ];
}

/**
 * {@inheritdoc}
 */
public function actions()
{
    return [
        'error' => [
            'class' => 'yii\web\ErrorAction',
        ],
        'captcha' => [
            'class' => 'yii\captcha\CaptchaAction',
            'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
        ],
    ];
}

public function actionUadmin()
    {

        return $this->render('uadmin');
        
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        // $this->layout = 'authorization';
        // echo "<script>console.log('Hello World');</script>";
        // $this->layout = 'main';
      
         $model = new LoginForm();
         //$this->render('login',['model'=>$model,]);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->render('uadmin');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
       ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Signup action.
     *
     * @return Response|string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goHome();
        }

        return $this->render('signup', ['model' => $model]);
    }


}