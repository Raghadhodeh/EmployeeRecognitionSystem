<?php

/** @var yii\web\View $this */
/** @var string $content */

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

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
 //$model( ['labelOptions'=>['style'=>'color:yellow']] ) ;


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

$this->title = 'My Yii Application';
?>


<div class="site-index">

<button class="button-create">
                  <?= Html::a('Admin Page','login_admin', ['class' => 'btn btn-primary']) ?>
                  

                  </button>
    <div class="jumbotron text-center bg-transparent">
   

     <h5 class="path"><span style="color:#31c4f5">Home </span>> Dashboard </h5>
     <img class="profile" src="<?= \Yii::getAlias('@web/images/ProfilePhoto.jpg')?>" />

    </div>
    
    <div class="posts">
    
        <!-- <h6 style= "color:#16d6f8;"></h6>
        <img class="empty-post" src="<?= \Yii::getAlias('@web/images/EmptyPost.jpg')?>" />
        <h6 class="heading-post">Heading 1</h6>
        <img class="empty-post" src="<?= \Yii::getAlias('@web/images/EmptyPost.jpg')?>" />
        <h6 class="heading-post">Heading 2</h6> -->

<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'post_text',
    'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
    'itemOptions' => [
        'tag' => false
    ]
    
]) ?>


    </div>
                 

    <div class="body-content">

        <div class="row">

            <div class="col-lg-4">
               
                <!-- <input type="text" class="search-box" placeholder="Search.."> -->
                
            </div>
            
              <div class="new-post">           
                  <img class="upload" src="<?= \Yii::getAlias('@web/images/upload.png')?>" />
                  <h6 class="pop-tag" >Create new post ? </h6>
            
                  <button class="button-create">
                  <?= Html::a('create','/posts/create', ['class' => 'btn btn-primary']) ?>
                  

                  </button>
                 
              </div>

            </div>
           
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
       'options' =>['class' => ' active-dashboard ' ],
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
