<?php
namespace app\models;

use Yii;
use yii\base\Model;

class FormForm  extends Model{
    public $name;
    public $email;
    public $password;
    public $password_repeat;



public function rules(){
 
    return[
        [['name','password','password_repeat','email'],'required'],
        [['name','password','password_repeat'],'string','min' => 4 , 'max' => 16],
        ['password_repeat','compare','compareAttribute'=>'password']
    ];
}


public function form()
{
    if (!$this->validate()) {
        return null;
    }
    $user =new User();
    $user -> name = $this-> name;
    $user -> email = $this-> email;
    $user->password = \yii::$app->security-> generatePasswordHash($this->password);
   
    //if (!$user->validate()) return false;

    if($user->save(false)){
        return true;
    }
   return false;
}   
}