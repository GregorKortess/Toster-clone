<?php
/* @var $this \yii\web\View */
/* @var $question \frontend\models\Questions */
/* @var $tag \frontend\models\Tags */

$user = $question->user;


use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\helpers\Url;

?>


<div class="row">
    <div class="col-md-12">
        <a href="<?php echo Url::to(['/user/profile/view','nickname' => $user->getNickname()])?>"><?php echo Html::encode($user->username); ?></a>
        <small>@<?php echo Html::encode($user->nickname); ?></small>
        <hr>
    </div>

    <div class="col-md-12">
        <b>Тэг:</b>
        <br>
        <img src="<?php echo Yii::$app->storage->getFile($tag->picture) ?>" width="25" height="25">
        <a href="<?php echo Url::to(['/tags/default/view','id' => $tag->id]) ?>"><?php echo $tag->name ?></a>
        <div class="h3"><?php echo Html::encode($question->question); ?></div>
    </div>
    <div class="col-md-12">
        <?php echo Html::encode($question->description) ?>
        <br><br>
        <?php if($question->filename): ?>
        <img src="<?php echo $question->getImage();?>" >
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

    <hr>

    <div class="col-md-12">
        Likes: <span class="likes-count"><?php echo $question->countLikes(); ?></span>


        <a href="#" class="btn btn-default button-like" style="<?php echo ($currentUser && $question->isLikedBy($currentUser)) ? "display:none" : "" ?>" data-id="<?php echo $question->id ?>">
            Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
        </a>
        <a href="#" class="btn btn-default button-unlike" style="<?php echo ($currentUser && $question->isLikedBy($currentUser)) ? "" : "display:none" ?>" data-id="<?php echo $question->id ?>">
            Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
        </a>
    </div>




<?php $this->registerJsFile('@web/js/likes.js',[
        'depends' => JqueryAsset::className(),
]);


