<?php


namespace frontend\modules\user\controllers;


use Yii;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function actionView($nickname)
    {
        return $this->render('view',[
            'user' => $this->findUser($nickname)
        ]);
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