<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\BookType */

$this->title = 'Update Book Type: ' . ' ' . $model->book_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Book Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->book_type_id, 'url' => ['view', 'id' => $model->book_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
