<?php

namespace frontend\models;

use Yii;
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
}
