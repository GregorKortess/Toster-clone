<?php

namespace frontend\models;

use Yii;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $picture
 * @property string $name
 * @property string $description
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picture' => 'Picture',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    // Получить список тэгов для формы создания вопроса
    public static function getTagsList()
    {
        return ArrayHelper::map(self::find()->orderBy('name')->all(), 'id', 'name');
    }

    // Колличество вопросов для тэга
    public function getQuestions()
    {
        return $this->hasMany(Questions::className(),['tag' => 'id'])->count();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getFollowers()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        $key = "tag:{$this->getId()}:followers";
        $ids = $redis->smembers($key);
        return User::find()->select('id, nickname , picture , username')->where(['id' => $ids])->asArray()->all();

    }

    /**
     * @return mixed
     */
    public function countFollowers()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard("tag:{$this->getId()}:followers");
    }


}
