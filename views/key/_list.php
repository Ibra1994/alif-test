<?php
use yii\helpers\Html;
use app\models\User;
/** @var $model \app\models\Key */
?>

<div style="color: #495057; background-color: #FFFFFF; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.21); margin-top: 15px">
    <div style="padding: 25px; height: 140px">
        <div class="col-sm-3">
            <p></p>
            <p><?= Yii::t('app', 'Lock') ?>: <?= $model->lock->name ?></p>
            <p><?= Yii::t('app', 'User') ?>: <?= date('m-d-Y', $model->created_at) ?></p>
        </div>
        <div class="col-sm-8">
            <p style="font-size: 26px"><?= $model->name ?></p>
            <p><?= Yii::t('app', 'Date') ?>: <?= date('m-d-Y', $model->created_at) ?></p>
            <p><?= Yii::t('app', 'Updated') ?>: <?= date('m-d-Y', $model->updated_at) ?></p>
        </div>

            <div class="col-sm-1">
                <div><?= Html::a('<i class="fa fa-camera"></i>  ' . Yii::t('app', 'View'), ['/key/view', 'id' => $model->id]) ?></div>
                <?php if (User::isAdmin()): ?>
                    <div><?= Html::a('<i class="fa fa-pencil"></i>  ' . Yii::t('app', 'Edit'), ['/key/update', 'id' => $model->id]) ?></div>
                    <div><?= Html::a('<i class="fa fa-trash"></i>  ' . Yii::t('app', 'View'), ['/key/delete', 'id' => $model->id], ['data-confirm' => "Are you sure you want to delete this item?", 'data-method' => "post"]) ?></div>
                <?php endif; ?>
            </div>

    </div>
</div>

