<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Book Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'book_type_id',
            'book_type_name',
            'book_type_title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
