<?php

namespace app\controllers;

use Yii;

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
     public function actionSpeak($message = 'Fill in your Personal Information :')
      { 
        return $this->render("speak",['message' => $message]); 
     } 
    /**
     * {@inheritdoc}
     */
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [''],
               // 'except' => ['login'] ,
                'rules' => [
                    [
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPosts()
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Posts::find()->all()
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        return $this->render('posts');
       // return $this->render('index');
    }


  
    public function actionForm()
    {
       
       $model = new \app\models\user();
     
       if ($model->load(Yii::$app->request->post())) {
       if ($model->validate()) {
                  // return ;   
            // form inputs are valid, do something here
          yii::$app->session->setFlash('success','You have entered the data correctly');
        }
    }
         return $this->render('form', ['model' => $model, ]);
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
        if ($model->load(Yii::$app->request->post()) && $model->login() && $this->admin = 1) {
            return $this->render('/admin/index');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
       ]);
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

        
    public function actionAdmin()
    {

        return $this->render('admin');
        
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
     * Displays contact page.
     *
     * @return Response|string
     */
    
    public function actionContact()
    {

        $model = new InfoForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {   
       // return $this->render('info', ['model' => $model]
            return $this->render('infoconfirm');   
        } else {   
            // either the page is initially displayed or there is some validation error   
            return $this->render('info', ['model' => $model]);   
        }   
        
    

}

 
public function actionCreate()
{

    return $this->render('create');
//     $model = new CreateForm();

//     if ($model->load(Yii::$app->request->post()) && $model->validate()) {   
//    // return $this->render('info', ['model' => $model]
//         return $this->render('create');   
//     } else {   
//         // either the page is initially displayed or there is some validation error   
//         return $this->render('create', ['model' => $model]);   
//     }   
}

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionRegistration() {
        $mRegistration = new RegistrationForm();
        return $this->render('registration', ['model' => $mRegistration]);
     }

     /**
     * Displays dashboard page.
     *
     * @return string
     */
    public function actionDashboard()
    {  
        return $this->render('dashboard');
    }


     
   
}

