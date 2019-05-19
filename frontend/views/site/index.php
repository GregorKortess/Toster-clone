<?php

/* @var $this yii\web\View */
/* @var $users frontend\models\User */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <h1 align="center">Users</h1>
    <?php foreach ($users as $user): ?>

        <a href="<?php echo Url::to(['user/profile/view','nickname' => $user->getNickname()])?>">
    <?php echo $user->username; ?>
        </a>
        <hr>

    <?php endforeach; ?>

    </div>
</div>
