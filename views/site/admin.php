<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

nav::widget([
    
    'options' =>[
     'class' => ' flex-column nav-pills'
    ],
    'items' => [
     [
         'label' => 'Dashboard',
         'url' => ['/site/dashboard'] ,
         'labelOptions'=>['style'=>'color:yellow']
     ]]]);

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
        ['label' => 'Hello ' .Yii::$app->user->identity->name],
        ['label' => ' (Admin Page) ']
           //. Html::echo( yii::$app->user->name )
    ],
     
]);

echo Nav::widget([
    'options' => ['class' => 'navbar-nav ml-auto'],
    'items' => [
        Yii::$app->user->isGuest ? (
            ['label' => '', 'url' => ['/admin/login']]
        ) : (
            '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline '])
            . Html::submitButton(
                'Logout ',
                ['class' => 'btn btn-link  ']
            )
         
            . Html::beginForm(['/site/info'], 'post', ['class' => 'form-inline '])
            . Html::submitButton(
                'Create User',
                ['class' => 'btn btn-link  ']
            )
            . Html::endForm()
            . '</li>'
            ),
        
        ],
    ]);
    
        
NavBar::end();

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <br><br><br>

        <p class="display-4">Wellcome to admin page </p>
        <br>

        <h4> Create new user  </h4>
        <div class="body-content">
   
            <button class="button-view">
                <?= Html::a('View','/posts/index_admin', ['class' => 'btn btn-primary']) ?>
            </button>
      </div>
     
       <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Create ', 'url' => ['/site/signup_admin']]
   
            ):( 
                ['label' => 'Create ', 'url' => ['/site/signup_admin']]
            )
        ]]); ?>


        <br><br>

        
       <h3> View all posts  </h3>
    </div> 

    
    <div class="body-content">

        <!-- <div class="row">

            <div class="col-lg-4">
                <input type="text" class="search-box" placeholder="Search..">

            </div> -->
       </div>
    </div>
