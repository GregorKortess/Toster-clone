<?php

namespace frontend\models;

use Yii;
use yii\db\Connection;
use yii\helpers\FormatConverter;

/**
 * This is the model class for table "questions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $filename
 * @property string $question
 * @property string $description
 * @property int $created_at
 * @property string $difficulty
 * @property string $tag

 */
class Questions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions';
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'question' => 'Question',
            'description' => 'Description',
            'created_at' => 'Created At',
            'difficulty' => 'Difficulty',
        ];
    }

    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);
    }


    /**
     * Получить автора вопроса
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }


    /**
     * @param User $user
     */
    public function like(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->sadd("question:{$this->getId()}:likes",$user->getId());
        $redis->sadd("user:{$user->getId()}:likes",$this->getId());
    }


    /**
     * @param User $user
     */
    public function unLike(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $redis->srem("question:{$this->getId()}:likes",$user->getId());
        $redis->srem("user:{$user->getId()}:likes",$this->getId());
    }

    /**
     * @return mixed
     */
    public function countLikes()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard("question:{$this->getId()}:likes");
    }


    public function getId()
    {
        return $this->id;
    }

    public function isLikedBy(User $user)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->sismember("question:{$this->getId()}:likes", $user->getId());
    }

    public function getUserFeed($currentUser)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;

        $ids = $redis->smembers("user:{$currentUser->id}:subscriptions");

        return self::find()->where(['tag' => $ids])->select('filename,id,question,created_at,difficulty')->orderBy('created_at',SORT_ASC)->all();
    }

}
