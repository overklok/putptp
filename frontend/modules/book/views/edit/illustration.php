
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use kartik\widgets\FileInput;
use common\modules\book\models\BookIll;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Book */

//Уже выбраны

!empty($model->book_title) ? $model->book_title : $model->book_type_id = "";
!empty($model->book_description) ? $model->book_description : $model->book_description = "";

$covr = BookIll::getIllsByBook($model->book_id, true);
$ills = BookIll::getIllsByBook($model->book_id);


?>

<div class="book-edit-illustration">

    <?php $form = ActiveForm::begin([
        'id' => 'filter_form',
        'options' => ['class' => 'clearfix'],
    ])
    ?>
    <h2>Illustrations can bring your book to life. Cover
        the face of your book </h2>

    <p>Add illustrations and cover. You can always come back later and add more.</p>
    <hr>

    <h3><b>Cover</b></h3>

    <?/*= $form->field($model->settings, 'book_cover')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['/book/ill/' . $model->book_id . '/upload?cover=true']),
    ]
    ]); */?>

    <?= FileInput::widget([
        'name' => 'file[]',
        'options'=>[
        ],
        'pluginOptions' => [
            'initialPreview' => $covr,
            'uploadUrl' => Url::to(['/book/ill/' . $model->book_id . '/upload?cover=true']),
            'maxFileCount' => 1,
            'allowedFileTypes' => ['image'],
            'maxFileSize' => 10000,
        ],

    ]); ?>


    <h3><b>Illustrations</b></h3>
    <?= FileInput::widget([
        'name' => 'file[]',
        'options'=>[
            'multiple'=>true,
            'dropZoneEnabled' => false,
        ],
        'pluginOptions' => [
            'initialPreview' => $ills,
            'uploadUrl' => Url::to(['/book/ill/' . $model->book_id . '/upload']),
            'overwriteInitial'=> false,
            'maxFileCount' => 10,
            'allowedFileTypes' => ['image'],
            'maxFileSize' => 10000,
        ],

    ]); ?>

    <br />

    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>

    <? ActiveForm::end(); ?>

</div>
