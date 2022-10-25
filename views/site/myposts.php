<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\InfoForm $model */
use yii\data\ActiveDataProvider;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\grid\ActionColumn;
use yii\grid\GridView;

//use yii\captcha\Captcha;
NavBar::begin([
    'brandLabel' => '',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => ' navbar-expand-lg navbar-light bg-light shadow-sm fixed-top',],
]);


echo Nav::widget([

    'options' => ['class' => 'navbar-nav '],
    'items' => [
        Yii::$app->user->isGuest ?
        ['label' => 'Hello']:
        ['label' => 'Hello ' .Yii::$app->user->identity->name]
           //. Html::echo( yii::$app->user->name )
    ],
     
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => [
        Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline '])
            . Html::submitButton(
                'Logout ',
                ['class' => 'btn btn-link  ']
            )
            . Html::endForm()
            . '</li>'
            ),

    ],
]);
NavBar::end();

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('View my posts', ['/posts'], ['class' => 'btn btn-success']) ?>
</p>
    
</div>

<?

/** @var yii\web\View $this */
?>

 <div>
      <div class="jumbotron text-center bg-transparent">

            <h5 class="path"><span style="color:#31c4f5">Home </span>> My Posts</h5>
            <img class="profile" src="<?= \Yii::getAlias('@web/images/ProfilePhoto.jpg')?>" />

      </div>
     


     <div class="site-contact">
          <h1><?= Html::encode($this->title) ?></h1>





    
        </div>
    </div>

</div>
    

<aside class= "">
<?php echo \yii\bootstrap4\Nav::widget([
    
   'options' =>[
    'class' => ' flex-column nav-pills '
   ],
   
   'items' => [
    [
        'label' => 'Dashboard',
        'url' => ['/site/dashboard'] 

    ],
    [
        'label' => 'My Team',
        'url' => ['/site/speak']
    ],
    [ 
        'label' => 'My Info ',
        'url' => ['/site/info']
    ],
    [
        'label' => 'Favourites',
        'url' => ['/site/about']
    ],
    [
        'label' => 'My Posts',
        'url' => ['/site/myposts']
    ],
    [
        'label' => 'Mentiones',
        'url' => ['/site/my_mentiones']
    ]
   ]

]) ;
?>
 


