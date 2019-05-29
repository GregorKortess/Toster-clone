<?php

namespace frontend\modules\question\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\Questions;
use frontend\models\User;


class QuestionForm extends Model
{
    const MAX_QUESTION_LENGHT = 200;
    const MAX_DESCRIPTION_LENGHT = 3000;

    private $user;

    public $picture;
    public $description;
    public $question;
    public $difficulty;
    public $tag;


    public function rules()
    {
        return [
          [['picture'],'file',
              'skipOnEmpty' => true,
              'extensions' => ['jpg','png'],
              'checkExtensionByMimeType' => true,
              'maxSize' => $this->getMaxFileSize()],
            [['description'],'string','max' => self::MAX_DESCRIPTION_LENGHT],
            [['question'],'string','max' => self::MAX_QUESTION_LENGHT],
            [['question','description','difficulty','tag'],'required'],
        ];
    }

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
        if ($this->validate()) {


            $question = new Questions();


            if ($this->picture) {
                $question->filename = Yii::$app->storage->saveUploadedFile($this->picture);
            }

            $question->question = $this->question;
            $question->description = $this->description;
            $question->difficulty = $this->difficulty;
            $question->created_at = time();
            $question->user_id = $this->user->getId();
            $question->tag = $this->tag;

            return $question->save(false);
        }
    }

    /**
     * Максимальный размер загружаемого файла
     * @return mixed
     */
    private function getMaxFileSize()
    {
        return Yii::$app->params['maxFileSize'];
    }


}
