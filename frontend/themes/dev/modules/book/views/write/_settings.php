<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model common\modules\book\models\BookChapter */

?>

<?$form = ActiveForm::begin(); ?>

<?= $form->field($model, 'chapter_title') ?>

    <div class="form-group" style="margin-top: 10px;">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?ActiveForm::end(); ?>