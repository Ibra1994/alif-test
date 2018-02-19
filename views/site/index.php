<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Lock management';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::a('Sign up', ['/site/login'], ['class' => 'btn btn-xs btn-success']) ?>
        <?php endif; ?>
    </div>
</div>
