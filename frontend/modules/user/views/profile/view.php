<?php
/* @var $this \yii\web\View */
/* @var $user frontend\models\User */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

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
