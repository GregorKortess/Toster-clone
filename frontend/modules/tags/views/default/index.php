<?php
/* @var $tags \frontend\models\Tags */


use yii\helpers\Html;
use yii\helpers\Url;
?>


    <a href="<?php echo Url::to('/tags/default/create') ?>" class="btn btn-default">Создать тэг</a>

<br><br>

<?php foreach ($tags as $tag): ?>

<img src="<?php echo Yii::$app->storage->getFile($tag->picture) ?>" width="100" height="100">
<b><?php echo $tag->name; ?></b>
    <br><br>
<p><?php echo $tag->description ?></p>

    <hr>


<?php endforeach; ?>


