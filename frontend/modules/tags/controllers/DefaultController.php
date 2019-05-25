<?php

namespace frontend\modules\tags\controllers;

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

        $tags = Tags::find()->all();

        return $this->render('index',[
            'tags' => $tags,
        ]);
    }

    public function actionView($id)
    {

        return $this->render('view',[
            'tag' => $this->findTag($id),
        ]);
    }

    public function actionCreate()
    {

        $model = new TagForm();

        if($model->load(Yii::$app->request->post())) {

            $model->picture = UploadedFile::getInstance($model,'picture');

            if ($model->save()) {
                Yii::$app->session->setFlash('success','Тэг создан');
                return $this->goHome();
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
}
