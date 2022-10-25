<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>


        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::a('Login Admin','/site/admin', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>


<!-- 

        <php echo Nav::widget([ 
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            Yii::$app->user->Admin='1' ? (
                ['label' => 'Create ', 'url' => ['/admin/signup']]
   
            ):( 
                ['label' => 'Create ', 'url' => ['/admin/signup']]
            )
        ]]); ?> -->


    <?php ActiveForm::end(); ?>
<?php 
// $name=$_POST['name'];
// echo $name;
?>


    
</div>
