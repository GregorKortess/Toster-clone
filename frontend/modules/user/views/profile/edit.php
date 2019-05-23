<?php
/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\forms\EditForm */
/* @var $user \frontend\models\User */
/* @var $modelPicture frontend\modules\user\models\forms\PictureForm */

use dosamigos\fileupload\FileUpload;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="profile-edit-index">
    <h1 align="center">Edit profile</h1>

    <img  src="<?php echo $user->getPicture(); ?>" id="profile-picture" width="150"  height="200"/>


    <div class="alert alert-success" style="display: none" id="profile-image-success">Profile image updated</div>
    <div class="alert alert-danger" style="display: none" id="profile-image-fail"></div>

    <a href="<?php echo Url::to(['/user/profile/delete-picture']); ?>" class="btn btn-danger">Delete picture</a>

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

    <br><br>

    <?php $form = ActiveForm::begin();?>



    <?php echo $form->field($model,'nickname'); ?>
    <br>

    <?php echo $form->field($model,'user_status')->label('Статус'); ?>
    <br>

    <?php echo $form->field($model,'firstName')->label('Имя'); ?>
    <br>

    <?php echo $form->field($model,'lastName')->label('Фамилия'); ?>
    <br>


    <?php echo $form->field($model,'about')->label('О себе')->textarea(['rows' => 10]); ?>
    <br>

    <?php echo Html::submitButton('Применить'); ?>



    <?php ActiveForm::end(); ?>
</div>
