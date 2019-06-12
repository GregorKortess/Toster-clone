<?php
/* @var $this \yii\web\View */
/* @var $tag \frontend\models\Tags */
/* @var $currentUser \frontend\models\User */

/* @var $questions \frontend\models\Questions */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-2 col-md-offset-5">
        <h2><?php echo $tag->name; ?></h2>
        <img src="<?php echo Yii::$app->storage->getFile($tag->picture) ?>" width="150" height="150" alt="">
        <br><br>
    </div>

</div>
<p align="center"><?php echo $tag->description ?></p>

<p align="center">ПОДПИСЩИКОВ: <?php echo $tag->countFollowers(); ?> || ВОПРОСОВ: <?php echo count($questions) ?> || РЕШЕНО:</p>
<p align="center">
    <?php  if (!$currentUser->isFollowed($tag)): ?>
    <a href="<?php echo Url::to(['/user/default/subscribe', 'id' => $tag->id]) ?>" class="btn btn-default">Подписаться</a>
    <?php  else: ?>
    <a href="<?php echo Url::to(['/user/default/unsubscribe', 'id' => $tag->id]) ?>" class="btn btn-default">Отписаться</a>
    <?php  endif; ?>
</p>

<p align="center">
    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal2">Подписщики тэга</a>
</p>
<hr>


<?php foreach ($questions as $question): ?>

    <?php echo Yii::$app->formatter->asDatetime($question->created_at) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php if ($question->difficulty == 'Лёгкий'): ?>
        <b class="text-success"><?php echo $question->difficulty ?></b>
    <?php elseif ($question->difficulty == 'Средний'): ?>
        <b class="text-warning"><?php echo $question->difficulty ?></b>
    <?php else: ?>
        <b class="text-danger"><?php echo $question->difficulty ?></b>
    <?php endif; ?>

    <br>
    <a href="<?php echo Url::to(['/question/default/view','id' => $question->id]) ?>"><b><?php echo $question->question; ?></b></a>
    <br>
    Подписщиков: 5 || Ответов: 6 ; &nbsp;&nbsp;&nbsp;&nbsp;
    <?php if ($question->status != 0): ?>
        <b class="text-success">Решён</b>
    <?php else: ?>
        <b class="text-danger">Не решён</b>
    <?php endif; ?>
    <hr>
<?php endforeach; ?>



<!-- Modal followers -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Подписщики тэга</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($tag->getFollowers() as $follower): ?>
                        <div class="col-md-12">
                            <a href="<?php echo Url::to(['/user/profile/view', 'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']]); ?>">
                                <img src="<?php echo ($follower['picture'])  ? Yii::$app->storage->getFile($follower['picture']) : '/img/default.png'; ?>"  width="15" height="15">
                                <?php echo Html::encode($follower['username']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal followers -->
