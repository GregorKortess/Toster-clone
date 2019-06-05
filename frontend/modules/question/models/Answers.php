<?php

namespace frontend\modules\question\models;

use frontend\models\User;
use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property int $author_id
 * @property int $question_id
 * @property int $status
 * @property string $text
 * @property string $picture
 * @property int $created_at
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
    }




    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'question_id' => 'Question ID',
            'status' => 'Status',
            'text' => 'Text',
            'picture' => 'Picture',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Get answers list for Question
     * @param $id
     */
    public function getAnswers($id)
    {
        return Answers::find()->where(['question_id' => $id])->orderBy('created_at')->all();
    }

    /**
     * Получить автора ответа
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id' => 'author_id']);
    }

    public function deleteAnswer($id)
    {
        return Answers::deleteAll(['id' => $id]);
    }
}
