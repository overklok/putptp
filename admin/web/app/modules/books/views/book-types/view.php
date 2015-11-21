<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\BookType */

$this->title = $model->book_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Book Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->book_type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->book_type_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'book_type_id',
            'book_type_name',
            'book_type_title',
        ],
    ]) ?>

</div>
