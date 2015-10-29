<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\icons\Icon;
Icon::map($this);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="book-edit-wrap">
    <?=
    Nav::widget(
        [
            'options' => [
                'class' => ['nav nav-pills nav-stacked col-sm-3'],

            ],
            'activateItems' => true,
            'encodeLabels' => false,

            'items' => [
                [
                    'label' => 'Genre ' . Icon::show('plus'),
                    'url' => \yii\helpers\Url::to(['/book/edit/' . $_GET['id'] . '/genre'])
                ],
                [
                    'label' => 'Description ' . Icon::show('minus'),
                    'url' => \yii\helpers\Url::to(['/book/edit/' . $_GET['id'] . '/description'])
                ],
                [
                    'label' => 'Illustration & Cover '  . Icon::show('minus'),
                    'url' => \yii\helpers\Url::to(['/book/edit/' . $_GET['id'] . '/illustration'])
                ],
                [
                    'label' => 'Detailed Description ' . Icon::show('minus'),
                    'url' => ['#'],
                ],
                [
                    'label' => 'Content Protection ' . Icon::show('minus'),
                    'url' => ['#'],
                ],
                [
                    'label' => 'Pricing ' . Icon::show('minus'),
                    'url' => ['#'],
                ],
            ],

        ]
    )
    ?>
    <div class="book-edit-content col-sm-9">
    <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>