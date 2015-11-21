<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_id')->textInput() ?>

    <?= $form->field($model, 'book_type_id')->textInput() ?>

    <?= $form->field($model, 'genre_id')->textInput() ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_status')->textInput() ?>

    <?= $form->field($model, 'book_images_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
