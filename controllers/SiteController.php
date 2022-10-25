<?php

namespace app\controllers;

use Yii;
use app\models\Posts;
use app\models\Likes;
use app\models\user;
use yii\data\ActiveDataProvider;
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


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['*'],
                 'except' => ['login' ,'admin' ] ,
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
                    // 'contact' => ['post'],
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


    public function actionSpeak(){
        $dataProvider = new ActiveDataProvider([
        'query' =>user::find()->andwhere(['Team_id' => 1])
        ]);
        return $this->render('speak', [
        'dataProvider' => $dataProvider,
        ]);
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
        //$this->layout = 'authorization';
        // echo "<script>console.log('Hello World');</script>";
        // $this->layout = 'main';
      
         $model = new LoginForm();
         //$this->render('login',['model'=>$model,]);
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // return $this->render('/dashboard');
            return $this->actionDashboard();
        }

        //$model->password = '';
        return $this->render('login', [
            'model' => $model,
       ]);
       
    }

    public function actionLogin_admin()
    {
        //$this->layout = 'authorization';
        // echo "<script>console.log('Hello World');</script>";
        // $this->layout = 'main';
        $model = new LoginForm();
         //$this->render('login',['model'=>$model,]);
        if ((Yii::$app->user->identity->Admin==1) ) {
            // return $this->render('/dashboard');
            return $this->actionAdmin();
        }

        //$model->password = '';
        return "sorry! can not login you are not an admin";
    // $this->render('login', [
    //         'model' => $model,
    //    ]);
       
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


    public function actionSignup_admin()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goHome();
        }

        return $this->render('signup', ['model' => $model]);
    }

    // public function actionAdmin()
    // {

    //     $model = new LoginForm();
    //      //$this->render('login',['model'=>$model,]);
    //     if ($model->load(Yii::$app->request->post()) && $model->login()) {
    //         return $this->render('admin');
    //     }

    //     $model->password = '';
    //     return $this->render('login', [
    //         'model' => $model,
    //    ]);
       
    // }
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
    
    public function actionInfo()
    {

        $model = new InfoForm();
        

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {   
        return $this->render('info', ['model' => $model]);
           // return $this->render('infoconfirm');   
        } else {   
            // either the page is initially displayed or there is some validation error   
            return $this->render('info', ['model' => $model]);   
        }         
    }
     
    public function actionCreate()
    {
        return $this->render('create');
    }

    
    public function actionAdmin()
    {
        
            return $this->render('admin');
    }




//     $model = new CreateForm();

//     if ($model->load(Yii::$app->request->post()) && $model->validate()) {   
//    // return $this->render('info', ['model' => $model]
//         return $this->render('create');   
//     } else {   
//         // either the page is initially displayed or there is some validation error   
//         return $this->render('create', ['model' => $model]);   
//     }   

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $like = Likes::find()->where(['Users_id' => \Yii::$app->user->id])->one();
        if($like) {
            $dataProvider = new ActiveDataProvider([
                'query' =>Posts::find()->andwhere(['id' => $like->Posts_id])
            ]);
             return $this->render('about',['dataProvider' => $dataProvider]);
        } else {
        //     $dataProvider = new ActiveDataProvider([
        //         'query' =>Posts::find()->all()
        //     ]);
        // }
        return $this->render('aboutE');
        }
    
    }

    public function actionMy_mentiones()
    {
           //$post = Posts::find()->one();
            $dataProvider = new ActiveDataProvider([
                'query' =>Posts::find()->andwhere(['mentioned' =>\Yii::$app->user->identity->name])
            ]);
             return $this->render('my_mentiones',['dataProvider' => $dataProvider]);
       
        }
    
    

    // $like = Likes::find()->where(['Users_id' => \Yii::$app->user->id])->one();
    //     if($like) {
    //         $query = Posts::find()->andwhere(['id' => $like->Posts_id]);
         
    //     }
    //         $dataProvider = new ActiveDataProvider([
    //             'query' => $query
    //         ]);


    public function actionMyposts()
    {
        return $this->render('myposts');
    }

    
    
    public function actionRegistration() {
       // $mRegistration = new RegistrationForm();
        return $this->render('registration');
     }

     /**
     * Displays dashboard page.
     *
     * @return string
     */
    public function actionDashboard()
    {  
        $dataProvider = new ActiveDataProvider([
            'query' => Posts::find()->andwhere(['Status'=> Posts::STATUS_PUBLISHED])
        
        ]);
        // echo $dataProvider;
        return $this->render('dashboard',['dataProvider' => $dataProvider]);
    }
 
    // public function actionFindTeam()
    // {   
    //        $sql="select * from db";
    //         $command=Yii::app()->db->createCommand($sql)->queryAll();
    //         foreach($command as $commands)
    //         echo $commands['name']; 
    //     }



    
    }


