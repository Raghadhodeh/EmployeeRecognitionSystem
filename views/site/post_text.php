<?php

namespace app\models;
use yii\helpers\Url;
use yii\widgets\Pjax;
use Yii;

?>
<div class="card m-3" style="width: 20rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">

  <?php //echo $model->id ?></h6> 

   <h6 class="card-title m-2"><?php echo //\Yii::$app->user->identity->name  
   $model->created_by ?> </h6>
   <h6> mentiones <?php echo $model->mentioned ?></h6>
    <h5 class="card-title"><?php echo $model->Text ?></h5>
     
    
    <p class="text-muted card-text m-0">
            <?php //echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>
        </p>
  
 <?php \yii\widgets\Pjax::begin() ?>
    
     <?php echo $this->renderAjax('/posts/_buttons', [
                    'model' => $model
                ]) ?>

     <?php \yii\widgets\Pjax::end() ?> 

        
  </button>

  </div>
  <div>
    </div>
</div>


