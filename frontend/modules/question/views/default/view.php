<?php
/* @var $this \yii\web\View */
/* @var $question \frontend\models\Questions */
/* @var $tag \frontend\models\Tags */
/* @var $model \frontend\modules\question\models\forms\AnswersForm */
/* @var $answers \frontend\modules\question\models\Answers */
/* @var $currentUser \frontend\models\User */
$user = $question->user;

use frontend\modules\question\models\Answers;
use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<!--Вопрос-->
<div class="row">
    <div class="col-md-12">
        <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => $user->getNickname()]) ?>"><?php echo Html::encode($user->username); ?></a>
        <small>@<?php echo Html::encode($user->nickname); ?></small>
        <hr>
    </div>

    <div class="col-md-12">
        <b>Тэг:</b>
        <br>
        <img src="<?php echo Yii::$app->storage->getFile($tag->picture) ?>" width="25" height="25">
        <a href="<?php echo Url::to(['/tags/default/view', 'id' => $tag->id]) ?>"><?php echo $tag->name ?></a>
        <div class="h3"><?php echo Html::encode($question->question); ?></div>
    </div>
    <div class="col-md-12">
        <?php echo Html::encode($question->description) ?>
        <br><br>
        <?php if ($question->filename): ?>
            <img src="<?php echo $question->getImage(); ?>">
        <?php endif; ?>
    </div>

    <div class="col-md-12">
        <hr>
        <?php if ($question->difficulty == 'Лёгкий'): ?>
            <h3 class="text-success"><?php echo Html::encode($question->difficulty); ?></h3>
        <?php elseif ($question->difficulty == 'Средний'): ?>
            <h3 class="text-warning"><?php echo Html::encode($question->difficulty); ?></h3>
        <?php else: ?>
            <h3 class="text-danger"><?php echo Html::encode($question->difficulty); ?></h3>
        <?php endif; ?>
        <b>Ответы:<?php echo Answers::countAnswers($question->getId()) ?></b>
        <br>
        <b><?php echo Yii::$app->formatter->asDatetime($question->created_at) ?></b>

        <hr>
    </div>

</div>
<!--Вопрос-->

<!--Лайки-->
<div class="col-md-12">
    Likes: <span class="likes-count"><?php echo $question->countLikes(); ?></span>


    <a href="#" class="btn btn-default button-like" style="<?php echo ($currentUser && $question->isLikedBy($currentUser)) ? "display:none" : "" ?>" data-id="<?php echo $question->id ?>">
        Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
    </a>
    <a href="#" class="btn btn-default button-unlike" style="<?php echo ($currentUser && $question->isLikedBy($currentUser)) ? "" : "display:none" ?>" data-id="<?php echo $question->id ?>">
        Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
    </a>
</div>
<!--Лайки-->

<!--Решенеие-->
<?php if ($solutions = Answers::getSolutions($question->id)): ?>
    <h3 align="center" class="text-success">Решения вопроса</h3>
    <?php foreach ($solutions as $solution): ?>
        <hr>
        <?php if ($solution->user->picture): ?>
            <img src="<?php echo Yii::$app->storage->getFile($solution->user->picture) ?>" width="45" height="45">
        <?php else: ?>
            <img src="/img/default.png" width="45" height="45">
        <?php endif; ?>

        <b><?php echo Html::encode($solution->user->username) ?></b>
        <i><?php echo Html::encode($solution->user->userStatus) ?></i>
        <br>
        <?php echo Html::encode($solution->text); ?>


        <?php if ($solution->picture): ?>
            <br>
            <img src="<?php echo Yii::$app->storage->getFile($solution->picture) ?> " width="450" height="600">
        <?php endif; ?>
        <br><br>
    <?php if($currentUser->equals($question->user)): ?>
        <a class="btn btn-danger button-revokeSolution" data-UserId="<?php echo $solution->author_id ?>" data-QuestionId="<?php echo $question->id ?>" data-id="<?php echo $solution->id; ?>" href="#">Отменить решение</a>
    <?php endif; ?>

        <br><br>
    <?php endforeach; ?>
    <div class="col-md-12">

    </div>
<?php endif; ?>
<!--Решение-->

<!-- Список комментариев -->
<h3 align="center">Ответы на вопрос:</h3>
<hr>
<?php if ($answers): ?>

    <div class="col-md-12">
        <?php foreach ($answers as $answer): ?>
            <?php if ($answer->user->picture): ?>
                <img src="<?php echo Yii::$app->storage->getFile($answer->user->picture) ?>" width="45" height="45">
            <?php else: ?>
                <img src="/img/default.png" width="45" height="45">
            <?php endif; ?>

            <b><?php echo Html::encode($answer->user->username) ?></b>
            <i><?php echo Html::encode($answer->user->userStatus) ?></i>
            <br>
            <?php echo Html::encode($answer->text); ?>


            <?php if ($answer->picture): ?>
                <br>
                <img src="<?php echo Yii::$app->storage->getFile($answer->picture) ?> " width="450" height="600">
            <?php endif; ?>

            <br><br>

            <?php if ($currentUser->equals($answer->user)) : ?>
                <a class="btn btn-default button-delete" href="#" data-QuestionId="<?php echo $question->id ?>" data-id="<?php echo $answer->id; ?>">Удалить ответ</a>
            <?php endif; ?>

            <?php if ($currentUser->equals($question->user) && $answer->status == 0): ?>
                <a class="btn btn-success button-solution" data-UserId="<?php echo $answer->author_id ?>" data-QuestionId="<?php echo $question->id ?>" data-id="<?php echo $answer->id; ?>" href="#">Отметить как решение</a>
            <?php endif; ?>

            <?php if ($currentUser->equals($question->user) && $answer->status == 1): ?>
                <a class="btn btn-danger button-revokeSolution" data-UserId="<?php echo $answer->author_id ?>" data-QuestionId="<?php echo $question->id ?>" data-id="<?php echo $answer->id; ?>" href="#">Отменить решение</a>
            <?php endif; ?>

            <?php if ($answer->status == 1): ?>
                <p align="center" class="h4 text-success"><span class="glyphicon glyphicon-ok">&nbsp;</span>Ответ помечен как решение</p>
            <?php endif; ?>
            <hr>

        <?php endforeach; ?>
        <br><br>
    </div>
<?php else: ?>
    <h4 align="center" class="text-warning">Похоже ответов на вопрос пока нету</h4>
<?php endif; ?>
<!--Список комментариев -->

<!--Создать комментарий-->
<h3 align="center">Ваш ответ на вопрос</h3>


<div class="col-md-12">
    <?php $form = ActiveForm::begin() ?>

    <div class="h4">Текст:</div>
    <?php echo $form->field($model, 'text')->label(false)->textarea(['rows' => 8]); ?>


    <div class="h4">Изображение:</div>
    <small>Вы можете добавить изображение для более точного ответа</small>
    <br>
    <?php echo $form->field($model, 'picture')->label(false)->fileInput(['class' => 'btn btn-default']); ?>
    <br>

    <?php echo Html::submitButton('Отправить', ['class' => 'btn btn-default']); ?>

    <?php ActiveForm::end(); ?>

</div>
<!--Создать комментарий-->

<div id="bottom"></div>

<!--Зависимости-->

<?php $this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
]); ?>

<?php $this->registerJsFile('@web/js/deleteAnswer.js', [
    'depends' => JqueryAsset::className(),
]); ?>

<?php $this->registerJsFile('@web/js/solution.js', [
    'depends' => JqueryAsset::className(),
]); ?>

<!--Зависимости-->



