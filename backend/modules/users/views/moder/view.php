<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\detail\DetailView;
use app\components\grid\LinkColumn;
use app\components\detail\UserDetail;

use app\modules\books\models\Book;

/* @var $this yii\web\View */
/* @var $model common\modules\user\models\User */

/* @var $searchModel app\modules\books\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$title_content = empty($model->user_first_name) ? $model->user_name :
    $model->user_last_name . ", " . $model->user_first_name . " " . $model->user_middle_name;

$this->title = 'User Info: ' . $title_content;

$this->params['breadcrumbs'][] = ['label' => 'Users Control', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= Html::img('/uploads/user/image/1.jpg', ['alt'=>'some', 'class'=>'img-thumbnail col-md-2 hidden-xs hidden-sm']);?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => UserDetail::getAttributes($model),
        'options' => [
            'class' => 'col-md-10'
        ],

    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => LinkColumn::className(),
                'attribute' => 'book_title',
                'module' => 'books',
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
