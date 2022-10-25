<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;


    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-lg navbar-light bg-light shadow-sm fixed-top',],
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

/** @var yii\web\View $this */

$this->title = 'My Favourites';
?>

    <div claass="about">

        <div class="jumbotron text-center bg-transparent">

            <h5 class="path"><span style="color:#31c4f5">Home </span>> Favourites</h5>
            <img class="profile" src="<?= \Yii::getAlias('@web/images/ProfilePhoto.jpg')?>" />

        </div>


        <div class="site-about">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                Sorry! your favourite list posts is empty.
            </p>
        </div>

<!-- 
        <div class="post-">
        
             <h6 style= "color:#16d6f8;">New Posts</h6> 
        
            <img class="fav-post" src="<?= \Yii::getAlias('@web/images/EmptyPost.jpg')?>" />
            <h6 class="heading-photo">name 2</h6>
            <img class="fav-post" src="<?= \Yii::getAlias('@web/images/EmptyPost.jpg')?>" />
            <h6 class="heading-photo">name 3</h6>
         </div> -->


   </div>


</div>
<div class="post-index">
<!-- 
    <p>
     < Html::a('View my posts', ['/posts'], ['class' => 'btn btn-success']) ?>
    </p>
     -->
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
        'url' => ['/posts']
    ],
    [
        'label' => 'Mentiones',
        'url' => ['/site/my_mentiones']
    ]
   ]

]) ;


