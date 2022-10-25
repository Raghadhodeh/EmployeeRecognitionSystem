<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "{{%Posts}}".
 *
 * @property int $id
 * @property int $Users_id
 * @property string $Body
 * @property string $Date_created
 * @property int $num_likes
 * @property int $Body_id_Posts
 * @property string $Status
 * @property string $Background
 * @property string $Text
 * @property user        $createdBy
 * @property Favourite[] $favourites
 * @property Likes[] $likes
 * @property Mentiones[] $mentiones
 */


class Posts extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var \yii\web\UploadedFile
     */
    public $Posts;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Posts}}';
    }

    // public function behaviors()
    // {
    //     return [
    //         TimestampBehavior::class,
    //         [
    //             'class' => BlameableBehavior::class,
    //             'updatedByAttribute' => false
    //         ]
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'Text'], 'required'],
            //[['id', 'Users_id', 'Body', 'Date_created', 'num_likes', 'Body_id_Post', 'Status', 'Background', 'Text'], 'required'],
            [['Users_id', 'num_likes', 'Body_id_Post'], 'integer'],
            [['id'],'integer'],
            [['Date_created'], 'safe'],
            [['Text'], 'string'],
            [['Body', 'Status', 'Background'], 'string', 'max' => 45],
            //[['id'], 'unique'],
            ['Status', 'default', 'value' => self::STATUS_UNLISTED],
            [['created_by'],'string' ],
            //'exist', 'skipOnError' => true, 'targetClass' => user::className(), 'targetAttribute' => ['created_by' => 'name']],
            [['mentioned'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Users_id' => 'Users ID',
            'Body' => 'Body',
            'Date_created' => 'Date Created',
            'num_likes' => 'Num Likes',
            'Body_id_Post' => 'Body Id Post',
            'Status' => 'Status',
            'Background' => 'Background',
            'Text' => 'Text',
            'created_by' => 'Created By',
            'mentioned'=>'Mentioned'
        ];
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery|FavouriteQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourite::className(), ['Posts_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['created_by' => 'id']);
    }


    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery|LikesQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['Posts_id' => 'id']);
    }

    /**
     * Gets query for [[Mentiones]].
     *
     * @return \yii\db\ActiveQuery|MentionesQuery
     */
    public function getMentiones()
    {
        return $this->hasMany(Mentiones::className(), ['Posts_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostsQuery(get_called_class());
    }


    public function getPost()
    {
        return Yii::$app->$_GET($this->text);
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(user::className(), ['Users_id' => 'created_by']);
    }


    public function isLikedBy($user_id)
    {
        return Likes::find()
            ->userIdpostId($user_id, $this->id)
            ->liked();
            //->one();
    }



    // Yii::$app->params['frontendUrl'] . 'storage/videos/' . $this->video_id . '.mp4';
    
    //public function save ($runValidation = true, $attributeNames = null)
    // {
    //     $isInsert =$this->isNewRecord;
    //     if($isInsert){
    //        // $this->id =Yii::$app->security->generateRandomString(length:8);
    //         //$this->background=$this->Posts->name;
    //         //$this->=$this->posts->body;
    //     }
    //     $saved = parent::save($runValidation, $attributeNames);
    //     if(!$saved){
    //         return false;
    //     }
    //     if($isInsert){
    //         $postsPath = Yii::getAlias('@web/images/'.$this->id.'.png');
    //         if(!is_dir(dirname($postsPath))){
    //             FileHelper::createDirectory(dirname($postsPath));
    //             }
    //             $this->posts->saveAs($postsPath);

    //         }

    //         return true;

    //     }


    }



