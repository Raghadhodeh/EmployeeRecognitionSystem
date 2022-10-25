<?php

/** @var yii\web\View $this */
/** @var string $content */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

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
            ['label' => 'Login', 'url' => ['/admin/login']]
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


