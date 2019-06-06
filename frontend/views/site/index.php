<?php

/* @var $this yii\web\View */
/* @var $questions frontend\models\User */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h1 align="center">Вопросы</h1>
    <?php foreach ($questions as $question): ?>

        <a href="<?php echo Url::to(['question/default/view','id' => $question->id])?>">
    <?php echo $question->question ?>
        </a>
        <hr>

    <?php endforeach; ?>

    </div>
</div>
