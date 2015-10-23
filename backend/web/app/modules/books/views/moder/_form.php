<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\BookType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_type_title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
