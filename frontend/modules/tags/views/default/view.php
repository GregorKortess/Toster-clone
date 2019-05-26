<?php
/* @var $this \yii\web\View */
/* @var $tag \frontend\models\Tags */

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

<hr>


<?php foreach ($questions as $question): ?>

    <?php echo Yii::$app->formatter->asDatetime($question->created_at) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="text-success"><?php echo $question->difficulty ?></b>
    <br>
    <a href="<?php echo Url::to(['/question/default/view','id' => $question->id]) ?>"><b><?php echo $question->question; ?></b></a>
    <br>
    Подписщиков: 5 || Ответов: 6 ; &nbsp;&nbsp;&nbsp;&nbsp; <b class="text-danger">Не решён</b>
    <hr>
<?php endforeach; ?>
