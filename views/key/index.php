<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Lock;
use app\models\User;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KeySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Keys');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-index">

    <h1><?= Html::encode($this->title) . ' <span class="badge">' . $dataProvider->count .'</span>' ?></h1>
    <?php Pjax::begin(); ?>

    <?php if (User::isAdmin()): ?>
        <a href="<?= Url::to(['/key/create']) ?>">
            <div class="text-center" style="background-color: #dee2e6; font-size: 18px; margin-bottom: 20px">
                <div style="padding: 10px">
                    <div>
                        <i class="fa fa-plus"></i>
                    </div>
                    <?= Yii::t('app', 'NEW KEY') ?>
                </div>
            </div>
        </a>
    <?php endif; ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
    ]) ?>
    <?php Pjax::end(); ?>
</div>
