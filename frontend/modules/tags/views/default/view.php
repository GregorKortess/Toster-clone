<?php
/* @var $this \yii\web\View */
/* @var $tag \frontend\models\Tags */

use yii\helpers\Html;
?>

<div class="row">
    <div  class="col-md-2 col-md-offset-5">
        <?php echo $tag->name; ?>
        <br><br>
        <img src="<?php echo Yii::$app->storage->getFile($tag->picture) ?>" width="150" height="150" alt="">
        <br><br>
    </div>

</div>
<?php echo $tag->description ?>

<hr>
