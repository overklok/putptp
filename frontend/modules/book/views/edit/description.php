<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\modules\book\models\BookType;
use jlorente\remainingcharacters\RemainingCharacters;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Genre */

//Уже выбраны

!empty($model->book_title) ? $model->book_title : $model->book_type_id = "";
!empty($model->book_description) ? $model->book_description : $model->book_description = "";

?>

<div class="book-edit-description">

    <?php $form = ActiveForm::begin([
        'id' => 'filter_form',
        'options' => ['class' => 'clearfix'],
    ])
    ?>
    <h2>Tell Readers About Your Book </h2>

    <p>Every book on Put Pen To Paper is unique. Highlight what makes your book  so that
        it stands out to readers who want to read your work.</p>

    <?= $form->field($model, 'book_title')->textInput(['placeholder' => 'Be clear and descriptive.'])->label('Title of the book') ?>

        <?= $form->field($model, 'book_description')->widget(RemainingCharacters::classname(), [
            'type' => RemainingCharacters::INPUT_TEXTAREA,
            'text' => '{n} characters remaining',
            'options' => [
                'rows' => '6',
                'class' => 'col-md-12',
                'maxlength' => 250,
                'placeholder' => 'Tell readers about the plot of the book, but be careful don’t tell them more than they need to know. You can include details about characters, places and events that happen in the book. Remember your main task is to interest the reader. Good luck!'
                ]
        ])->label('Summary');
    ?>

    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>

    <? ActiveForm::end(); ?>

</div>
