<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \app\components\grid\LinkColumn;
use app\components\grid\UserNameColumn;
use yii\bootstrap\Nav;

use app\modules\books\models\Book;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\books\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books Control';
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

<div class="book-index col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => LinkColumn::className(),
                'attribute' => 'book_title',
                'module' => 'book',
                'value' => function($model, $key, $index, $column) {
                    $value = $model->{$column->attribute};

                    return $value === null ? 'No Name' : $value;
                }
            ],
            'book_id',
            [
                'class' => UserNameColumn::className(),
                'attribute' => 'user_name',
                //'value' => function ($model, $key, $index, $column) {
                //    /** @var User $model */
                //    /** @var \yii\grid\DataColumn $column */
                //
                //return '';
                //}
            ],
            [
                'filter' => Book::getBookTypesArray(),
                'attribute' => 'book_type_id',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    /** @var Book $model */
                    /** @var \yii\grid\DataColumn $column */
                    $value = $model->{$column->attribute};

                    $html = Html::tag('span', Html::encode($model->getBookTypeTitle()), ['class' => 'label label-default']);
                    return $value === null ? $column->grid->emptyCell : $html;
                }
            ],
            [
                'filter' => Book::getGenresArray(),
                'attribute' => 'genre_id',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    /** @var Book $model */
                    /** @var \yii\grid\DataColumn $column */
                    $value = $model->{$column->attribute};

                    $html = Html::tag('span', Html::encode($model->getGenreTitle()), ['class' => 'label label-default']);
                    return $value === null ? $column->grid->emptyCell : $html;
                }
            ],
            // 'book_description',
            [
                'filter' => Book::getStatusesArray(),
                'attribute' => 'book_status',
                'class' => 'app\components\grid\StatusColumn',
            ],
            // 'book_images_url:url',
            // 'created_at',
            // 'updated_at',
        ],
    ]); ?>

</div>
