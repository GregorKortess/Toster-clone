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

<?php endif; ?>

<br><br>

<h2 align="center"><?php echo $user->solutions ?>
    <?php echo $user->answers ?>
    <?php echo $user->questions ?>
    <?php echo $user->contribution ?>
</h2>
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






<hr>
