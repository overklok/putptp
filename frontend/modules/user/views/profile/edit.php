<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;

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
    <?= $form->field($model, 'user_image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- profile-edit -->