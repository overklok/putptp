<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\BookChapter */

?>

<?php $formText = ActiveForm::begin(); ?>

<?=$formText->field($model, 'chapter_content')->widget(CKEditor::className(),[
    'preset' => 'standard',
]);?>

<div class="form-group" style="margin-top: 10px;">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
</div>

<?ActiveForm::end(); ?>
