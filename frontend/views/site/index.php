<?php

/* @var $this yii\web\View */
/* @var $users frontend\models\User */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php foreach ($users as $user): ?>

        <a href="<?php echo Url::to(['user/profile/view','id' => $user->id])?>">
    <?php echo $user->username; ?>
        </a>
        <hr>

    <?php endforeach; ?>

    </div>
</div>
