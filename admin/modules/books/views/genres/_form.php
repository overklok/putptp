<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Genre */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genre-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'genre_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genre_title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>