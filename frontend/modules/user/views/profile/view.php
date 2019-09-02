<?php
/* @var $this \yii\web\View */
/* @var $user frontend\models\User */
/* @var $modelPicture  frontend\modules\user\models\forms\PictureForm */
/* @var $currentUser frontend\models\User */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;
use yii\helpers\Url;
?>

<h1 align="center"><?php echo $user->username; ?></h1>


<img src="<?php echo $user->getPicture(); ?>" id="profile-picture" width="150"  height="200"/>

<?php if ($currentUser &&
    $currentUser->equals($user)): ?>


<a class="btn btn-default" href="<?php echo Url::to(['/user/profile/edit','nickname' => $user->getNickname()]) ?>">Редактировать профиль</a>
<!--    <div class="profile-following">-->
        <a  class="btn btn-default" href="#" data-toggle="modal" data-target="#myModal1">Подписки на тэги: <?php echo $user->countSubscriptions() ?></a>

<?php endif; ?>

<br><br>

<h3 align="center">Решений: <?php echo intval($user->solutions * 100 / ($user->answers+1))  ?>%
    |Ответов:<?php echo $user->answers ?>
    |Вопросов:<?php echo $user->questions ?>
    |Вклад:<?php echo $user->contribution ?>
</h3>
<i><?php echo $user->userStatus ?></i>
<br>
<b>Имя:<?php echo $user->firstName ?></b>
<br>
<b>Фамилия:<?php echo $user->lastName ?></b>
<br>

<hr>
<br>
<i><?php echo $user->about ?></i>

<br><br>

<!-- Modal subscriptions -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Подписки на теги</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                   <?php foreach ($user->getSubscriptions() as $subscription): ?>
                   <div class="col-md-12">
                       <a href="<?php echo Url::to('/tag/'.$subscription['id']) ?>">
                           <img src="<?php echo Yii::$app->storage->getFile($subscription['picture']) ?>" alt="img" width="15" height="15">
                        <?php echo Html::encode($subscription['name']); ?>
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
<!-- Modal subscriptions -->
