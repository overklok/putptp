<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ProfileForm */
/* @var $form ActiveForm */
?>

<?=
Nav::widget(
    [
        'options' => [
            'class' => ['nav nav-pills nav-stacked col-sm-3'],
        ],
        'items' => [
            [
                'label' => 'Edit Profile',
                'url' => ['/user/profile/edit'],
            ],
            [
                'label' => 'Reviews',
                'url' => ['/user/profile/reviews'],
            ],
        ],
    ]
)
?>

<div class="profile-edit col-sm-7">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'user_first_name') ?>
    <?= $form->field($model, 'user_last_name') ?>

    <?= $form->field($model, 'user_image')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'allowedFileTypes' => ['image'],
        ],
        'pluginOptions' => [
            'showRemove' => false,
            'showClose' => false,
            'showUpload' => false,
            'uploadAsync' => true,
            'initialPreview' => Html::img($model->user_image, ['class' => 'file-preview-image']),
        ],
    ]); ?>
    <?= Html::a('Remove image', ['/user/profile/remove-img'], [
        'class' => 'btn btn-danger btn-xs',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]); ?>

    <div class="form-group" style="margin-top: 10px;">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- profile-edit -->
