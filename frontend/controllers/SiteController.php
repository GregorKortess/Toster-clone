<?php
namespace frontend\controllers;


use frontend\models\User;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Questions;


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
        $questions = Questions::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $this->render('index',[
            'questions' => $questions,
        ]);
    }




}
