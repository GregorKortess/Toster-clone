<?php
/* @var $this \yii\web\View */
/* @var $question \frontend\models\Questions */

$user = $question->user;

use yii\helpers\Html;
use yii\helpers\Url;

?>


<div class="row">
    <div class="col-md-12">
        <a href="<?php echo Url::to(['/user/profile/view','nickname' => $user->getNickname()])?>"><?php echo Html::encode($user->username); ?></a>
        <small>@<?php echo Html::encode($user->nickname); ?></small>
        <hr>
    </div>

    <div class="col-md-12">
        ТЕГИ:
        <div class="h3"><?php echo Html::encode($question->question); ?></div>
    </div>
    <div class="col-md-12">
        <?php echo Html::encode($question->description) ?>
        <br><br>
        <?php if($question->filename): ?>
        <img src="<?php echo $question->getImage();?>" width="350" height="400">
        <?php endif; ?>
    </div>

    <div class="col-md-12">
        <hr>
        <em><?php echo Yii::$app->formatter->asDatetime($question->created_at) ?></em>
        <br>
        <b><?php echo Html::encode($question->difficulty); ?></b>

        <hr>
    </div>



</div>
