<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

use app\modules\books\models\Book;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\Book */

$this->title = 'Book: ' . $model->book_title;
$this->params['breadcrumbs'][] = ['label' => 'Books Control', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->book_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->book_id], [
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
            [
                'group'=>true,
                'label'=>'Identification Information',
                'rowOptions'=>['class'=>'info']
            ],
                'book_id',
                [
                    'attribute' => 'book_title',
                    'format' => 'raw',
                    'value' => Html::a($model->book_title, Url::toRoute(['view', 'id' => (string) $model->book_id])),

                ],
                [
                    'label' => 'Author Username',
                    'format' => 'raw',
                    'value' => Html::a(($model->getAuthorNameById($model->author_id) . ' (' . $model->author_id . ')'), Url::toRoute(['/users/moder/view', 'id' => (string) $model->author_id])),

                ],
            [
                'group'=>true,
                'label'=>'Book Characteristics',
                'rowOptions'=>['class'=>'info']
            ],
                [
                    'filter' => Book::getBookTypesArray(),
                    'attribute' => 'book_type_id',
                    'label' => 'Book Type',
                    'value' => $model->getBookTypeTitle(),
                ],
                [
                    'filter' => Book::getGenresArray(),
                    'attribute' => 'genre_id',
                    'label'=>'Genre',
                    'format'=>'raw',
                    'value' => $model->getGenreTitle(),
                ],

                [
                    'filter' => Book::getStatusesArray(),
                    'attribute'=>'book_status',
                    'label'=>'Status',
                    'format'=>'raw',
                    'value' => $model->getStatusName(),
                ],

            [
                'attribute' => 'book_description',
                'type'=>DetailView::INPUT_TEXTAREA,
                'options' => ['rows' => 4]
            ],
            [
                'group'=>true,
                'label'=>'DB Information',
                'rowOptions'=>['class'=>'info']
            ],
                'created_at:datetime',
                'updated_at:datetime',
        ],
    ]) ?>

</div>
