<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use jlorente\remainingcharacters\RemainingCharacters;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Book */

//Уже выбраны

!empty($model->book_title) ? $model->book_title : $model->book_type_id = "";

?>

<div class="book-edit-det-desc">

    <?php $form = ActiveForm::begin([
        'id' => 'filter_form',
        'options' => ['class' => 'clearfix'],
    ])
    ?>
    <h2>Tell Readers About Your Book </h2>

    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>

    <? ActiveForm::end(); ?>

</div>
