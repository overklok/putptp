<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use common\modules\book\models\Genre;
use common\modules\book\models\BookType;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Genre */

//Уже выбраны
$model->genre_id = 1;
$model->book_type_id = 1;

?>

<div class="book-default-index">
    <div class="jumbotron">
        <h1>Start Writing</h1>
    </div>

    <?php $form = ActiveForm::begin([
        'id' => 'filter_form',
        'options' => ['class' => 'clearfix'],
    ])
    ?>

    <h2>Choose Type</h2>
    <div class="text-center">
        <?= $form->field($model, 'book_type_id', [
            'inline' => true,
            ])->radioList(
                BookType::getTypeList(),
                [
                    'class' => 'btn-group',
                    'data-toggle' => 'buttons',
                    'unselect' => null,
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                        Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                    },
                ]

        );
        ?>
    </div>

    <h2>Choose Genre</h2>
    <div class="text-center">
        <?= $form->field($model, 'genre_id', [
            'inline' => true,
        ])->radioList(
            Genre::getGenreList(),
            [
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-md btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                },
            ]

        );
        ?>
    </div>

    <?= Html::submitButton('Continue', ['class' => 'btn btn-primary']) ?>

    <? ActiveForm::end(); ?>

</div>
