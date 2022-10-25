<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class InfoForm extends Model{
    public $name;
    public $email;
    //public $password;
    public $age;
    public $phone_number;
    public $position;
    public $birthdate;
    public $gender;


    /**
     * @return array the validation rules.
     */

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['age', 'phone_number', 'position', 'birthdate','gender'], 'required']
    
        ];
    }

    /**
     * @return array customized attribute labels
     *
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */


public function signup()
{
    if (!$this->validate()) {
        return null;
    }
    //$user = new User();
    $user -> age = $this-> age;
    $user -> phone_number = $this-> phone_number;
    $user -> position = $this-> position;
    $user -> birthdate = $this-> birthdate;

    
    if($user->save()){
        return true;
    }
   return false;
}   
    
   /* public function radio($options = [], $enclosedByLabel = true)
    {
        if ($enclosedByLabel) {
            if (!isset($options['template'])) {
                $this->template = $this->form->layout === 'horizontal' ?
                    $this->horizontalRadioTemplate : $this->radioTemplate;
            } else {
                $this->template = $options['template'];
                unset($options['template']);
            }
            if (isset($options['label'])) {
                $this->parts['{labelTitle}'] = $options['label'];
            }
            if ($this->form->layout === 'horizontal') {
                Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
            }
            $this->labelOptions['class'] = null;
        }
        return parent::radio($options, false);
    }*/
}
