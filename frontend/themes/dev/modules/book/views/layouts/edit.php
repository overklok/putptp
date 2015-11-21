<?php

/* @var $this \yii\web\View */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use kartik\icons\Icon;

$book_id = Yii::$app->request->get('id');
Icon::map($this);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<h1><?= empty($this->context->bookTitle) ? 'Untitled' : $this->context->bookTitle ?></h1>

<div class="book-edit-wrap col-sm-3">
    <?=
    Nav::widget(
        [
            'options' => [
                'class' => ['nav nav-pills nav-stacked'],

            ],
            'activateItems' => true,
            'encodeLabels' => false,

            'items' => [
                '<li class="divider">General</li>',
                [
                    'label' => 'Genre ' . Icon::show('plus'),
                    'url' => \yii\helpers\Url::to(['/book/edit/' . $book_id . '/genre'])
                ],
                [
                    'label' => 'Description ' . Icon::show('plus'),
                    'url' => \yii\helpers\Url::to(['/book/edit/' . $book_id . '/description'])
                ],
                [
                    'label' => 'Illustrations & Cover '  . Icon::show('plus'),
                    'url' => \yii\helpers\Url::to(['/book/edit/' . $book_id . '/illustration'])
                ],
                '<li class="divider">Presentation of the book</li>',
                [
                    'label' => 'Detailed Description ' . Icon::show('plus'),
                    'url' => ['#'],
                ],
                '<li class="divider">Additional Settings</li>',
                [
                    'label' => 'Content Protection ' . Icon::show('plus'),
                    'url' => ['#'],
                ],
                '<li class="divider">Sale</li>',
                [
                    'label' => 'Pricing ' . Icon::show('plus'),
                    'url' => ['#'],
                ],
            ],

        ]
    )
?>
    <div class="form-group" style="margin-top: 10px;">

        <?= Html::a('Write Book', ['/book/write/' . $book_id . '/index'], ['class'=>'btn btn-primary']) ?>
    </div>
</div>
    <div class="book-edit-content col-sm-9">
    <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>