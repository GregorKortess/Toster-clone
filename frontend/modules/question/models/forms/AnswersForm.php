<?php
namespace frontend\modules\question\models\forms;

use frontend\modules\question\models\Answers;
use Yii;
use yii\base\Model;
use frontend\models\User;


class AnswersForm extends Model
{
    const MAX_TEXT_LENGTH = 1500;

    public $text;
    public $picture;

    private $user;
    private $question;

    public function rules()
    {
        return [
            [['picture'],'file',
                'skipOnEmpty' => true,
                'extensions' => ['jpg','png'],
                'checkExtensionByMimeType' => true,
                'maxSize' => $this->getMaxFileSize()],
            [['text'],'required'],
            [['text'],'string','max' => self::MAX_TEXT_LENGTH]
        ];

    }
    public function __construct(User $user, $question)
    {
        $this->user = $user;
        $this->question = $question;
    }
    public function save()
    {
        if ($this->validate()) {
            $answer = new Answers();

            $answer->author_id = $this->user->getId();
            $answer->question_id = $this->question->id;
            $answer->text = $this->text;
            if ($this->picture) {
                $answer->filename = Yii::$app->storage->saveUploadedFile($this->picture);
            }
            $answer->created_at = time();

            return $answer->save(false);
        }
    }

    private function getMaxFileSize()
    {
        return Yii::$app->params['maxFileSize'];
    }
}