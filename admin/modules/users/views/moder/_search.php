<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_name') ?>

    <?= $form->field($model, 'user_first_name') ?>

    <?= $form->field($model, 'user_middle_name') ?>

    <?= $form->field($model, 'user_last_name') ?>

    <?php // echo $form->field($model, 'user_auth_key') ?>

    <?php // echo $form->field($model, 'user_password_hash') ?>

    <?php // echo $form->field($model, 'user_password_reset_token') ?>

    <?php // echo $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_email_confirm_token') ?>

    <?php // echo $form->field($model, 'user_status') ?>

    <?php // echo $form->field($model, 'user_DOB') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
