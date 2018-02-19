<?php
use yii\helpers\Html;
/** @var $model \app\models\Lock */
?>

<div style="color: #495057; background-color: #FFFFFF; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.21); margin-top: 15px">
    <div style="padding: 25px; height: 100px">
        <div class="col-sm-2">
            <?php if (!empty($model->keys)) : ?>
                <?= Html::button("<i class='fa fa-far fa-key'></i> " . Yii::t('app', 'KEYS'), ['class' => 'btn btn-success dropdown-toggle', 'data-toggle' => "dropdown"]) ?>
                <ul class="dropdown-menu">
                    <?php foreach ($model->keys as $key): ?>
                        <li><?= Html::a($key->name, ['/key/view', 'id' => $key->id]) ?></li>
                    <?php endforeach;?>
                </ul>
            <?php else: ?>
                <?= Html::button("<i class='fa fa-chain-broken'></i> " . Yii::t('app', 'NO KEYS'), ['class' => 'btn btn-default']) ?>
            <?php endif; ?>
        </div>
        <div class="col-sm-9">
            <p style="font-size: 26px"><?= $model->name ?></p>
            <p><?= Yii::t('app', 'Date') ?>: <?= date('m-d-Y', $model->created_at) ?></p>
        </div>
        <div class="col-sm-1">
            <div><?= Html::a('<i class="fa fa-camera"></i>  ' . Yii::t('app', 'View'), ['/lock/view', 'id' => $model->id]) ?></div>
            <div><?= Html::a('<i class="fa fa-pencil"></i>  ' . Yii::t('app', 'Edit'), ['/lock/update', 'id' => $model->id]) ?></div>
            <div><?= Html::a('<i class="fa fa-trash"></i>  ' . Yii::t('app', 'View'), ['/lock/delete', 'id' => $model->id], ['data-confirm' => "Are you sure you want to delete this item?", 'data-method' => "post"]) ?></div>
        </div>

    </div>
</div>

