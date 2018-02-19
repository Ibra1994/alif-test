<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Lock;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Key */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lock_id')->dropDownList(ArrayHelper::map(Lock::find()->all(), 'id', 'name'), ['prompt'=>'Select lock']) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(), 'id', 'email'), ['prompt'=>'Select user']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
