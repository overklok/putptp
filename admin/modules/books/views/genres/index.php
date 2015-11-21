<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Genres';
$this->params['breadcrumbs'][] = $this->title;
?>

<?=
Nav::widget(
    [
        'options' => [
            'class' => ['nav nav-pills nav-stacked col-lg-2'],
        ],
        'items' => [
            [
                'label' => 'Main Information',
                'url' => ['/book/moder/index'],
            ],
            [
                'label' => 'Book Types',
                'url' => ['/book/types/index'],
            ],
            [
                'label' => 'Book Genres',
                'url' => ['/book/genres/index'],
            ],
            [
                'label' => 'Settings',
                'url' => ['/book/admin/settings'],
            ],
        ],

    ]
)
?>
<div class="genre-index col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Genre', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'genre_id',
            'genre_name',
            'genre_title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>