<?php
namespace frontend\controllers;


use frontend\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class SiteController extends Controller
{


    public function actions()
    {
        return [
            'error' => [
              'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index',[
            'users' => $users,
        ]);
    }


}
