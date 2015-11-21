<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\books\models\Book;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_type_id')->dropDownList(Book::getBookTypesArray()) ?>

    <?= $form->field($model, 'genre_id')->dropDownList(Book::getGenresArray()) ?>

    <?= $form->field($model, 'book_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'book_status')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
