<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $models common\modules\book\models\Book */
/* @var $pages yii\data\Pagination */

?>
    <h1>My Books</h1>

    <?php foreach ($models as $i=>$model) { ?>
        <div class="user-books-elem">
            <?php $book_title = !empty($model->book_title) ? $model->book_title : 'Untitled';?>

            <h3><?= Html::a($i+1 . '. ' . $model->getBookTypeTitle() . ': ' . $book_title, ['#']); ?></h3>
            <p><?= Html::a('[edit]', [Url::to(['/book/edit/' . $model->book_id . '/description'])]) ?>
            <?= Html::a('[write]', ['/book/write/' . $model->book_id . '/index']);?></p>
            <p>Genre:
                <?= $model->getGenreTitle(); ?>
            </p>
            <p>Status:
                <?= $model->getStatusName(); ?>
            </p>
        </div>
    <?php } ?>

    <?=LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>