<?php

namespace app\controllers;
use Yii;

use app\models\Posts;
use app\models\Likes;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;



/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
             
            'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        //'create' => ['GET'],['POST'],
                    ],

                    'class' => VerbFilter::class,
                    'actions' => [
                        'like' => ['POST'],
                    ],
                ],
            
            ];
    }

    /**
     * Lists all Posts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Posts::find()->creator( Yii::$app->user->id),
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
        ]);

        return $this->render('index', [
         'dataProvider' => $dataProvider,
        ]);
       // return $this->render('index');
    }


    public function actionIndex_admin()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Posts::find(),
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
        ]);

        return $this->render('index_admin', [
         'dataProvider' => $dataProvider,
        ]);
       // return $this->render('index');
    }

    /**
     * Displays a single Posts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionView_admin()
    {
        return $this->render('view', [
            'model' => $this->find()->all(),
        ]);
    }
    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    // public function actionCreate()
    // {
    //     $model = new Posts();

    //     $model->posts = UploadedFile::getInstanceByName('Posts');
    //     if (Yii::$app->request->isPost && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }
    public function actionCreate()
    {
        $model = new Posts();
         if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
        
       // $model->posts= UploadedFile::getInstanceByName('posts');
       
       // if ($this->request->isPost) {
        //     if (Yii::$app->request->isPost && $model->save()) {
        //         return $this->redirect(['update', 'id' => $model->id]);
        // //     }
        // // } else {
        // //     $model->loadDefaultValues();
        // }
        //
        // $file=UploadedFile::getInstanceByName(name:'posts');
        //  echo '<pre>';
        //  var_dump($file);
        //  echo '</pre>';
        //  exit;



    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



    public function actionLike($id)
    {
        $this->layout ='auth';
        $posts = $this->findPost($id);
        $user_id = \Yii::$app->user->id;


         $likes = \app\models\Likes::find()
        ->andWhere([
            'posts_id' => $id,
            'Users_id' => $user_id
        ]) ->one();

        if(!$likes){
            
        $likes = new Likes();
        $likes->Posts_id = $id;
        $likes->Users_id = $user_id;
        // $likes->validate();
        // if ($likes->errors) return $this->asJson($likes->errors);
        $likes->save();
        }
        else if ($likes){
            $likes->delete();
        }
         return $this ->renderAjax('_buttons',[
            'model' => $posts,
        ]);
     }





    //     $this->layout ='auth';
    //     $posts = $this->findPost($id);
    //     $user_id = \Yii::$app->user->id;

    //     if(!$likes){
            
    //     $likes = new Likes();
    //     // $likes->Posts_id = $id;
    //     //$likes->id = $Users_id;
        
    //     $likes->Posts_id = $id;
    //     $likes->Users_id = $user_id;

    //     $likes->validate();
    //     if ($likes->errors) return $this->asJson($likes->errors);
    //     $likes->save();
   
    //      $likes = \app\models\Likes::find()
    //     ->andWhere([
    //         'posts_id' => $id,
    //         'user_id' => $Users_id
    //     ]) ->one();
    //      return $this ->renderAjax('_buttons',[
    //         'model' => $posts,
    //     ]);
    //  }


     protected function findPost($id){

        $posts =Posts::findone($id);
        if(!$posts){
            throw new NotFoundHttpException("post dose not exit");
        }
        return $posts;
     }

     

    

        // $postsLike= PostLike::find()
        //     ->one();
        // if (!$postsLike) {
        //     $this->saveLike($id, $User_id, PostLike::TYPE_LIKE);
        // } else if ($postLike->type == PostLike::TYPE_LIKE) {
        //     $postsLike->delete();
        // } else {
        //     $postsLike->delete();
        //     $this->saveLike($id, $User_id, PostLike::TYPE_LIKE);
        // }

        // return $this->renderAjax('_buttons', [
        //     'model' => $posts
        // ]);
    }

