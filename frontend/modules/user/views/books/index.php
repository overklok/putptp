<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use common\modules\book\models\Book;
use common\modules\book\models\BookType;
use common\modules\book\models\Genre;

/* @var $this yii\web\View */
/* @var $models common\modules\book\models\Book */
/* @var $pages yii\data\Pagination */

$book_title = !empty($model->book_title) ? $model->book_title : 'Untitled';

?>

    <?php foreach ($models as $i=>$model) { ?>
        <div class="user-books-elem">
            <h3><?= Html::a($i+1 . '. ' . $model->getBookTypeTitle() . ': ' . $book_title, ['#']); ?></h3>
            <p>Genre:
                <?= $model->getGenreTitle(); ?>
            </p>
            <p>Status:
                <?= $model->getStatusName(); ?>
            </p>
        </div>
    <?};?>

    <?=LinkPager::widget([
        'pagination' => $pages,
    ]);
    // display pagination
    ?>