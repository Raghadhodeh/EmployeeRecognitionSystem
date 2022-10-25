<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
 

/**
 * This is the model class for table "user".
 * @property string $name
 * @property string $email
 * @property integer $phone_number
 * @property string $Position
 * @property integer $age 
 * @property string|null $password_repeat
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
     
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['name'], 'string', 'max' => 16],
            [['email', 'password_repeat', 'password'], 'string', 'max' => 255],            
            [['email'], 'unique'],
                   
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password_repeat' => 'Password Repeat',
            'password' => 'Password',
            'phone_number' =>'Phone Number',
            'age' => 'Age',
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'position' => 'Position',
            'created_by' => 'Created By',   
                    
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|PostsQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Posts::className(), ['id' => 'created_by']);
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }
    public static function findIdentityByAccessToken($token , $type=null){
        return self::findOne(['accessToken'=>$token]);
    }

    public static function findByUsername($name){
        return self::findOne(['name'=>$name]);
    }

    public function getId(){
        return $this -> id;
    }

    public function getname(){
        return $this -> name;
    }


    public function getAuthKey(){
       return true;
    }

    public function validateAuthKey($authKey){
        return $this->authKey == $authKey;
    }
    public function validatePassword($password){
        return password_verify($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
   public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
 
}
