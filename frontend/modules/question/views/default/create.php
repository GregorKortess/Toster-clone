<?php
/* @var $this \yii\web\View */
/* @var $model \frontend\modules\question\models\forms\QuestionForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\Tags;



?>

<p class="question-default-index">

<div class="h2">Новый вопрос</div>
<hr>

<?php $form = ActiveForm::begin(); ?>

<div class="h3">Суть вопроса</div>
<small>Сформулируйте вопрос так, чтобы сразу было понятно, о чём речь.</small>
<br>
<?php echo $form->field($model, 'question')->label(false); ?>
<br>

<div class="h3">Категория вопроса</div>
<small>Выберите тэг благодаря которому можно будет найти ваш вопрос.</small>
<br>
<?php echo $form->field($model, 'tag')->label(false)->dropDownList(Tags::getTagsList()); ?>
<br>

<div class="h3">Детали вопроса</div>
<small>Опишите в подробностях свой вопрос, чтобы получить более точный ответ.</small>
<br>
<?php echo $form->field($model, 'description')->label(false)->textarea(['rows' => 5]); ?>
<br>

<div class="h3">Изображение</div>
<small>Вы можете добавить изображение вашего вопроса.</small>
<br>
<?php echo $form->field($model, 'picture')->label(false)->fileInput(); ?>
<br>

<div class="h3">Сложность вопроса</div>
<br>
<?php echo $form->field($model, 'difficulty')->label(false)->dropDownList(['Лёгкий' => 'Лёгкий', 'Средний' => 'Cредний', 'Сложный' => 'Сложный']); ?>
<br>

<?php echo Html::submitButton(); ?>

<?php ActiveForm::end(); ?>

</div>
