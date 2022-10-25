<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\InfoForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
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



/** @var yii\web\View $this */

?>
 <div>
      <div class="jumbotron text-center bg-transparent">

            <h5 class="path"><span style="color:#31c4f5">Home </span>> My Info</h5>
            <img class="profile" src="<?= \Yii::getAlias('@web/images/ProfilePhoto.jpg')?>" />

      </div>
     


     <div class="site-signup">
          <h1><?= Html::encode($this->title) ?></h1>

          <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                'inputOptions' => ['class' => 'col-lg-3 form-control'],
                'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
         ],
         ]); ?> 

            <?php $radio_ary = ['male' => 'Male','female' => 'Female'] ?>


            <?= $form->field($model, 'name')->textInput(['autofocus' => true])?>
            
            <?= $form->field($model, 'email')->input('email') ?>

            <?= $form->field($model, 'age')->input(['age']) ?>
          
            <?= $form->field($model, 'position') ->input('position') ?>   

            <?= $form->field($model, 'birthdate') ->input(['birthdate'])?>  
            
            <?= $form->field($model, 'phone_number') ->input(['phone_number']) ?> 
                
            <?= $form->field($model, 'gender')->radioList($radio_ary) ?> 
                

            <!-- <div class="form-group">
                <div class="offset-lg-1 col-lg-11">
                </div>
          </div> -->

     <div class="form-group">
            <div class="offset-lg-1 col-lg-11">
                <?= Html::submitButton('Sign up', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                <!--  echo 'console.log('. json_encode( $data ) .')' ?> -->

            </div>
       </div>


     <?php ActiveForm::end(); ?>
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
        'url' => ['/posts']
    ],
    [
        'label' => 'Mentiones',
        'url' => ['/site/my_mentiones']
    ]
   ]

]) ;
?>
 


