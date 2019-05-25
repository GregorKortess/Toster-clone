<?php

namespace frontend\modules\tags\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\Tags;

class TagForm extends Model
{
    const MAX_DESCRIPTION_LENGTH = 2000;

    public $picture;
    public $name;
    public $description;

    public function rules()
    {
        return [
            [['picture'], 'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg', 'png'],
                'checkExtensionByMimeType' => true,
                'maxSize' => $this->getMaxFileSize()],
            [['name', 'description'], 'required'],
            [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGTH],
        ];

    }

    public function save()
    {
        if ($this->validate()) {

            $tag = new Tags();

            $tag->name = $this->name;
            $tag->picture = Yii::$app->storage->saveUploadedFile($this->picture);
            $tag->description = $this->description;

            return $tag->save(false);
        };
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