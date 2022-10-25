<?php   

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html; 
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\ActiveForm;



Nav::widget([
    
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
?>

<div class="confirm">
    <h3>You have entered the following information:</h3>   
    <br>
    <!-- <ul>   
        <li><label>Age</label>: <?= Html::encode($model->age) ?></li>   
        <li><label>Phone Number</label>: <?= Html::encode($model->phone_number) ?></li>   
        <li><label>Position</label>: <?= Html::encode($model->position) ?></li>   
     <li><label>Birthdate</label>: <?= Html::encode($model->birthdate) ?></li>   
    </ul> -->

</div>


<div class="form-group">
       <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
</div>

