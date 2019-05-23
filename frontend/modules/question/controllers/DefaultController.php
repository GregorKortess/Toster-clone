<?php

namespace frontend\modules\question\controllers;

use yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\modules\question\models\forms\QuestionForm;
use frontend\models\Questions;


/**
 * Default controller for the `question` module
 */
class DefaultController extends Controller
{

    /**
     * Рендерит страницу для добавления вопросов
     * @return string
     */
    public function actionCreate()
    {

        $model = new QuestionForm(Yii::$app->user->identity);

        if($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model,'picture');

            if ($model->save()) {
                Yii::$app->session->setFlash('success','Вопрос создан');
                return $this->goHome();
            }
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view',[
            'question' => $this->findQuestion($id),
        ]);
    }

    private function findQuestion($id)
    {
        if ($user = Questions::findOne($id)) {
            return $user;
        }
        throw new yii\web\NotFoundHttpException();
    }
}
