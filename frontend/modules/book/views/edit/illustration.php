
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use common\modules\book\models\BookType;
use jlorente\remainingcharacters\RemainingCharacters;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Genre */

//Уже выбраны

!empty($model->book_title) ? $model->book_title : $model->book_type_id = "";
!empty($model->book_description) ? $model->book_description : $model->book_description = "";

?>

<div class="book-edit-illustration">

    <?php $form = ActiveForm::begin([
        'id' => 'filter_form',
        'options' => ['class' => 'clearfix'],
    ])
    ?>
    <h2>Tell Readers About Your Book </h2>

    <?= FileInput::widget([
        'name' => 'attachment_49[]',
        'options'=>[
            'multiple'=>true
        ],
        'pluginOptions' => [
            'initialPreview'=>[
                Html::img("/images/moon.jpg", ['class'=>'file-preview-image', 'alt'=>'The Moon', 'title'=>'The Moon']),
                Html::img("/images/earth.jpg",  ['class'=>'file-preview-image', 'alt'=>'The Earth', 'title'=>'The Earth']),
            ],
            'initialCaption'=>"The Moon and the Earth",
            'overwriteInitial'=>false
        ]
    ]); ?>

    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>

    <? ActiveForm::end(); ?>

</div>
