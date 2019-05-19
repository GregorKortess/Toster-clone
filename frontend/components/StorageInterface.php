<?php

namespace frontend\components;

use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;
use yii\web\UploadedFile;

interface StorageInterface
{

    public function saveUploadedFile(UploadedFile $file);

    public function getFile($filename);
}