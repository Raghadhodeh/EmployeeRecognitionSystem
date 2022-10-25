<?php
namespace app\models;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\ActiveRecord;



/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form ActiveForm */

class Users extends \yii\db\ActiveRecord 
{
     
 /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
}
?>
<div>

   <br>
   <p> Fill in your info please  </p>
    
   <br><br>

    <div class="form">

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password') ?>
            <?= $form->field($model, 'password_repeat') ?>
        
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>

    </div>

</div>
<!-- form -->
