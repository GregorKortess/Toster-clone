<?php


namespace frontend\modules\user\controllers;


use Yii;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\modules\user\models\forms\PictureForm;
use yii\web\UploadedFile;

class ProfileController extends Controller
{
    public function actionView($nickname)
    {

        $modelPicture = new PictureForm();

        return $this->render('view',[
            'user' => $this->findUser($nickname),
            'modelPicture' => $modelPicture,
        ]);
    }

    public function actionUploadPicture()
    {
        $model = new PictureForm();
        $model->picture = UploadedFile::getInstance($model,'picture');

        if ($model->validate()) {

            $user = Yii::$app->user->identity;
            $user->picture = Yii::$app->storage->saveUploadedFile($model->picture);

            if ($user->save(false,['picture'])) {
                print_r($user->attributes);die;
            }

        }

    }

    /**
     * @param $nickname
     * @return $user
     * @throws NotFoundHttpException
     */
    private function findUser($nickname)
    {
        if($user = User::find()->where(['nickname' => $nickname])->orWhere(['id' => $nickname])->one()) {
            return $user;
        }
        throw new NotFoundHttpException();
    }


}