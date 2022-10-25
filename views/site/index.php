<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Nav;
/** @var yii\web\View $this */

$this->title = 'My system';?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <br><br><br>

        <p class="display-4">Wellcome </p>
        <br>

        <h4>  New user ? </h4>

       <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Sign up', 'url' => ['/site/signup']]
   
            ):('<li>'  . '</li>'), ],
        ]); ?>


        <br><br>
       
        <h4>  Already have account </h4>
        
        <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : ('<li>' . '</li>' ),
        ],
    ]);?>
    

    </div> 

