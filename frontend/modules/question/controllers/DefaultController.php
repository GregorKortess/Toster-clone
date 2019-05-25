<?php

namespace frontend\modules\question\controllers;

use frontend\models\User;
use yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\Response;
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
        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        return $this->render('view',[
            'question' => $this->findQuestion($id),
            'currentUser' => $currentUser,
        ]);
    }

    public function actionLike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        Yii::$app->response->format = Response:: FORMAT_JSON;


        $id = Yii::$app->request->post('id');
        $question = $this->findQuestion($id);

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $question->like($currentUser);

        return [
            'success' => true,
            'likesCount' => $question->countLikes(),
        ];
    }

    public function actionUnlike()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        Yii::$app->response->format = Response:: FORMAT_JSON;


        $id = Yii::$app->request->post('id');
        $question = $this->findQuestion($id);

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $question->unLike($currentUser);

        return [
            'success' => true,
            'likesCount' => $question->countLikes(),
        ];
    }

    private function findQuestion($id)
    {
        if ($user = Questions::findOne($id)) {
            return $user;
        }
        throw new yii\web\NotFoundHttpException();
    }
}
