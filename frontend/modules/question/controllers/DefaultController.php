<?php

namespace frontend\modules\question\controllers;

use frontend\models\Tags;
use frontend\models\User;
use frontend\modules\question\models\Answers;
use frontend\modules\question\models\forms\AnswersForm;
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

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

    /**
     * Генерирует просмотр вопроса
     *
     * @param $id
     * @return string
     * @throws yii\web\NotFoundHttpException
     */
    public function actionView($id)
    {

        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Вы должны быть зарегестрированым что бы просматривать вопросы');
            return $this->redirect(['/user/default/login']);
        }

        /* @var $currentUser User */
        $currentUser = Yii::$app->user->identity;

        $question = $this->findQuestion($id);
        $model = new AnswersForm($currentUser, $question);

        // Модель для  формы ответов и список всех ответов под вопросом
        $answersModel = new Answers();
        $answers = $answersModel->getAnswers($id);

        if($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model, 'picture');

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Комментарий добавлен');
                return $this->redirect('/question/' . $id . '#bottom');
            }
        }

        $tag = $this->findTag($question->tag);

        return $this->render('view',[
            'question' => $question,
            'currentUser' => $currentUser,
            'tag' => $tag,
            'model' => $model,
            'answers' => $answers,
        ]);
    }

    /**
     * @return array|Response
     * @throws yii\web\NotFoundHttpException
     */
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

    /**
     * @return array|Response
     * @throws yii\web\NotFoundHttpException
     */
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

    /**
     * @return Response
     */
    public function actionDeleteAnswer()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/user/default/login']);
        }

        Yii::$app->response->format = Response:: FORMAT_JSON;

        $currentUser = Yii::$app->user->identity;
        $id = Yii::$app->request->post('id');
        $QuestionId = Yii::$app->request->post('QuestionId');

        $answer = new Answers();
        $answer->deleteAnswer($id,$currentUser);

        Yii::$app->session->setFlash('success','комментарий удалён');
        return $this->redirect('/question/'.$QuestionId);
    }

    /**
     * Отметить ответ как решение.
     * В методе Solution изменяем статус вопроса, ответа и добавляем +1 к решениям автора ответа
     *
     * @throws yii\web\NotFoundHttpException
     */
    public function actionSolution()
    {
        Yii::$app->response->format = Response:: FORMAT_JSON;

        $questionId = Yii::$app->request->post('QuestionId');
        $answerId = Yii::$app->request->post('id');
        $userId = Yii::$app->request->post('UserId');

        $answer = $this->findAnswer($answerId);
        $user = $this->findUser($userId);

        $question = $this->findQuestion($questionId);
        $question->solution($answer,$user);

        Yii::$app->session->setFlash('success','Ответ помечен как решение');
        return $this->redirect('/question/'.$questionId);
    }

    public function actionRevokeSolution()
    {
        Yii::$app->response->format = Response:: FORMAT_JSON;

        $questionId = Yii::$app->request->post('QuestionId');
        $answerId = Yii::$app->request->post('id');
        $userId = Yii::$app->request->post('UserId');

        $answer = $this->findAnswer($answerId);
        $user = $this->findUser($userId);

        $question = $this->findQuestion($questionId);
        $question->revokeSolution($answer,$user);

        Yii::$app->session->setFlash('warning','Ответ больше не помечен как решение');
        return $this->redirect('/question/'.$questionId);
    }



    private function findUser($id)
    {
        if ($user = User::findOne($id)) {
            return $user;
        }
        throw new yii\web\NotFoundHttpException();
    }

    private function findQuestion($id)
    {
        if ($question = Questions::findOne($id)) {
            return $question;
        }
        throw new yii\web\NotFoundHttpException();
    }

    private function findTag($id)
    {
        if ($tags = Tags::findOne($id)) {
            return $tags;
        }
        throw new yii\web\NotFoundHttpException();
    }

    private function findAnswer($id)
    {
        if ($answer = Answers::findOne($id)) {
            return $answer;
        }
        throw new yii\web\NotFoundHttpException();
    }

}
