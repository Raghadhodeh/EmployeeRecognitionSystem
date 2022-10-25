<?php
namespace app\models;
use yii;
/** @var yii\web\View $this */
/** @var string $content */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;
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

    

   //echo $Team::find()->creator(Yii::$app->user->id),
   // $user = User::findOne(Yii::$app->user->id);

    //Html::echo (Yii::$app->user->identity->name);
    NavBar::end();

    
/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">

     <h5 class="path"><span style="color:#31c4f5">Home </span>> My Team </h5>
     <img class="profile" src="<?= \Yii::getAlias('@web/images/ProfilePhoto.jpg')?>" />
    
    
     <?php echo \yii\widgets\ListView::widget([
       'dataProvider' => $dataProvider,
       'itemView' => 'team_info',
       'layout' => '<div class="d-flex flex-wrap">{items}</div>{pager}',
       'itemOptions' => [
       'tag' => false
    ]
   
]) ?>

    </div>



  
    <!-- <div class="body-content">

        <div class="row">

            <div class="col-lg-4">
                <input type="text" class="search-box" placeholder="Search..">
            </div>
            
              <div class="new-post">           
                  <img class="upload" src="<\Yii::getAlias('@web/images/upload.png')?>" />
                  <h6 class="pop-tag" >Create new post ? </h6>
                  <button class="button-create">Create</button>
              </div>

            </div>
           
        </div> 
    
    <div class="post">
        <h6 style= "color:#16d6f8;">New Posts</h6> -->
        <!-- <img class="empty-photo" src="<?= \Yii::getAlias('@web/images/female.jpg')?>" />
        <h6 class="heading-photo">name 1</h6>
        
        <img class="empty-photo" src="<?= \Yii::getAlias('@web/images/female.jpg')?>" />
        <h6 class="heading-photo">name 4</h6>
   </div>

   <div class="post">
        <img class="empty-photo" src="<?= \Yii::getAlias('@web/images/male.jpg')?>" />
        <h6 class="heading-photo">name 2</h6>
        <?php //echo Yii::$app->user->identity->name;
        //echo User::find('name');
     // $query = mysql_query("select * from user", $name);

    ?>

        <img class="empty-photo" src="<?= \Yii::getAlias('@web/images/male.jpg')?>" />
        <h6 class="heading-photo">name 5</h6>
   </div>

    <div class="post">
        <img class="empty-photo" src="<?= \Yii::getAlias('@web/images/male.jpg')?>" />
        <h6 class="heading-photo">name 3</h6>
        <img class="empty-photo" src="<?= \Yii::getAlias('@web/images/female.jpg')?>" />
        <h6 class="heading-photo">name 6</h6>
    </div>
    --> 

    </div>
</div>


<aside class= "">
<?php echo \yii\bootstrap4\Nav::widget([
    
   'options' =>[
    'class' => ' flex-column nav-pills'
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

