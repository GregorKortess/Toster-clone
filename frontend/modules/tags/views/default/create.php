<?php

/* @var $this \yii\web\View */
/* @var $model \frontend\modules\tags\models\forms\TagForm */

use  yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Создать тэг</h1>

<?php $form = ActiveForm::begin();?>


<?php echo $form->field($model,'name')->label('Название тэга');?>

<?php echo $form->field($model, 'picture')->label('Изображение')->fileInput(); ?>

<?php echo $form->field($model,'description')->label('Описание тега')->textarea(['rows' => 5]);?>


<?php echo Html::submitButton(); ?>

<?php ActiveForm::end(); ?>
