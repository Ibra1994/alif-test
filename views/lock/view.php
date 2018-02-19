<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Lock */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Locks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'label' => 'Keys',
                'format' => 'raw',
                'value' => function ($data) {
                    $return = null;
                    foreach ($data->keys as $key) {
                        $return .= '<span class="label label-primary">' . $key->name . '</span>';
                    }
                    return $return;
                }
            ],
            [
                'label' => 'Users',
                'format' => 'raw',
                'value' => function ($data) {
                    $return = null;
                    foreach ($data->users as $user) {
                        $return .= '<span class="label label-default">' . $user->email . '</span>';
                    }
                    return $return;
                }
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>
