<?php

namespace frontend\modules\tags\controllers;

use frontend\models\Questions;
use frontend\models\Tags;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use frontend\modules\tags\models\forms\TagForm;

/**
 * Default controller for the `tags` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $tags = Tags::find()->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index',[
            'tags' => $tags,
        ]);
    }

    /**
     * Просмотр тега и инфморации о нём
     * @param $id
     * @return string
     * @throws Yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {

        $tag = $this->findTag($id);
        $questions = $this->findQuestions($id);

        return $this->render('view',[
            'tag' => $this->findTag($id),
            'questions' => $questions,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        $model = new TagForm();

        if($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model,'picture');

            if ($model->save()) {
                Yii::$app->session->setFlash('success','Тэг создан');
                return $this->redirect(['/tags/']);
            }
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }


    private function findTag($id)
    {
        if ($user = Tags::findOne($id)) {
            return $user;
        }
        throw new yii\web\NotFoundHttpException();
    }

    private function findQuestions($id)
    {
        if ($question = Questions::find($id)->where(['tag' => $id])->orderBy(['created_at' => SORT_DESC])->all()) {
            return $question;
        }
        throw new yii\web\NotFoundHttpException();
    }
}
