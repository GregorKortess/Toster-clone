<?php
/* @var $tags \frontend\models\Tags */


use yii\helpers\Html;
use yii\helpers\Url;

?>


<a href="<?php echo Url::to('/tags/default/create') ?>" class="btn btn-default">Создать тэг</a>

<br><br>

<?php foreach ($tags as $tag): ?>


    <a href="<?php echo Url::to(['/tags/default/view', 'id' => $tag->id]) ?>">
        <p align="center">
            <img src="<?php echo Yii::$app->storage->getFile($tag->picture) ?>" width="100" height="100">

        </p>

    <p align="center"><b><?php echo $tag->name; ?> </b></p>

    <p align="center">Вопросов:<?php echo $tag->getQuestions(); ?></p>
    </a>

    <p align="center"><?php  if (!$currentUser->isFollowed($tag)): ?>
        <a href="<?php echo Url::to(['/user/default/subscribe', 'id' => $tag->id]) ?>" class="btn btn-default">Подписаться</a>
    <?php  else: ?>
        <a href="<?php echo Url::to(['/user/default/unsubscribe', 'id' => $tag->id]) ?>" class="btn btn-default">Отписаться</a>
    <?php  endif; ?></p>
    <p align="center"><?php echo $tag->description ?></p>

    <hr>
    <br>


<?php endforeach; ?>


