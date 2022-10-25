<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%Likes}}".
 *
 * @property int $id
 * @property int $Posts_id
 * @property int $Users_id
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Likes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'Posts_id', 'Users_id'], 'required'],
            [[ 'Posts_id', 'Users_id'], 'integer'],
            //[['id'], 'unique'],
        ];
    }

    /**z
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Posts_id' => 'Posts ID',
            'Users_id' => 'Users ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LikesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LikesQuery(get_called_class());
    }
}
