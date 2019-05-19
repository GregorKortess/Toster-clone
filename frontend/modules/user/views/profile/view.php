<?php
/* @var $this \yii\web\View */
/* @var $user frontend\models\User */
/* @var $modelPicture  frontend\modules\user\models\forms\PictureForm */
/* @var $currentUser frontend\models\User */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;
?>


<img src="<?php echo $user->getPicture(); ?>" id="profile-picture" width="150"  height="200"/>

<?php if ($currentUser->equals($user)): ?>

<div class="alert alert-success" style="display: none" id="profile-image-success">Profile image updated</div>
<div class="alert alert-danger" style="display: none" id="profile-image-fail"></div>

<?= FileUpload::widget([
    'model' => $modelPicture,
    'attribute' => 'picture',
    'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
    'options' => ['accept' => 'image/*'],
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                if (data.result.success) {
                    $("#profile-image-success").show();
                    $("#profile-image-fail").hide();
                    $("#profile-picture").attr("src", data.result.pictureUri);
                } else {
                    $("#profile-image-fail").html(data.result.errors.picture).show();
                    $("#profile-image-success").hide();
                }
            }',

    ],
]); ?>
<?php endif; ?>

<h1><?php echo $user->username; ?></h1>
<b><?php echo $user->firstName ?></b>
<b><?php echo $user->lastName ?></b>
<br>

<hr>
<i><?php echo $user->userStatus ?></i>
<br>
<i><?php echo $user->about ?></i>

<br>

<ul>
    <li><?php echo $user->solutions ?></li>
    <li><?php echo $user->answers ?></li>
    <li><?php echo $user->questions ?></li>
    <li><?php echo $user->contribution ?></li>
</ul>



<hr>
