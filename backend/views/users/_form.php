<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <? $items = [User::STATUS_ACTIVE, User::STATUS_DELETED]; ?>

    <? $options = [User::STATUS_ACTIVE => ['label' => 'Oks'], User::STATUS_DELETED]; ?>

    <?= $form->field($model, 'user_status')->dropDownList($items, $options) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
