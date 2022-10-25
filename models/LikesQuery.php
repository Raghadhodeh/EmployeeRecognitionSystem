<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Likes]].
 *
 * @see Likes
 */
class LikesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Likes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Likes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }


    public function userIdpostId($user_id , $posts_id){
        return $this->andWhere([
            'posts_id' => $posts_id,
             'user_id' => $user_id
        ]);

    }
    
    public function liked(){
        return $this;
    }


    
}
