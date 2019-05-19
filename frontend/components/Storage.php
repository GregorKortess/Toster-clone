<?php

namespace frontend\components;

use frontend\components\StorageInterface;
use Yii;
use yii\base\Component;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;


class Storage extends Component implements StorageInterface
{

    private $filename;


    /**
     * @param UploadedFile $file
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function saveUploadedFile(UploadedFile $file)
    {
        $path = $this->preparePath($file);

        if ($path  && $file->saveAs($path)) {
            return $this->filename;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     * @throws \yii\base\Exception
     */
    protected function preparePath(UploadedFile $file)
    {
        $this->filename = $this->getFileName($file);

        $path = $this->getStoragePath() . $this->filename;

        $path = FileHelper::normalizePath($path);

        if (FileHelper::createDirectory(dirname($path))) {
            return $path;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function getFilename(UploadedFile $file)
    {
        $hash = sha1_file($file->tempName);

        $name = substr_replace($hash,'/',2,0);
        $name = substr_replace($name,'/',5,0);

        return $name .'.'. $file->extension;
    }


    /**
     * @return bool|string
     */
    protected function getStoragePath()
    {
        return Yii::getAlias(Yii::$app->params['storagePath']);
    }

    public function getFile($filename)
    {
        return Yii::$app->params['storageUri'].$filename;
    }

}