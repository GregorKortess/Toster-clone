<?php

/* @var $this \yii\web\View */
/* @var $questions \frontend\models\Questions */


use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1 align="center">Ваша лента</h1>

<?php foreach ($questions as $question): ?>

    <?php echo Yii::$app->formatter->asDatetime($question->created_at) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b class="text-success"><?php echo $question->difficulty ?></b>
    <br>
    <a href="<?php echo Url::to(['/question/default/view','id' => $question->id]) ?>"><b><?php echo $question->question; ?></b></a>
    <br>
    Подписщиков: 5 || Ответов: 6 ; &nbsp;&nbsp;&nbsp;&nbsp; <b class="text-danger">Не решён</b>
    <hr>
<?php endforeach; ?>


