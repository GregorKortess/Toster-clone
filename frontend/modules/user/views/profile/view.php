<?php
/* @var $this \yii\web\View */
/* @var $user frontend\models\User */
/* @var $modelPicture  frontend\modules\user\models\forms\PictureForm */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;
?>


<img src="<?php echo $user->getPicture() ?>" alt="">
<?= FileUpload::widget([
    'model' => $modelPicture,
    'attribute' => 'picture',
    'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
    'options' => ['accept' => 'image/*'],
    'clientOptions' => [
        'maxFileSize' => 2000000
    ],
    // Also, you can specify jQuery-File-Upload events
    // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
    'clientEvents' => [
        'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
        'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
    ],
]); ?>


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
<img src="<?php echo $user->picture ?>" alt="">
