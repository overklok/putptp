<?php

use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\modules\book\models\Book */
/* @var $modelNewChap common\modules\book\models\BookChapter */

$current_book_id = $model->book_id;//Yii::$app->request->get('id');
$current_chap_id = $model->chapter->chapter_id;

$model->chapter->chapter_content = !empty($model->chapter->chapter_content) ? $model->chapter->chapter_content: "There is still empty...";

$items = array();

$this->title = ($model->book_title ? $model->book_title : 'Untitled') . ': ' . $model->chapter->chapter_title;

$tabItems = [
    [
        'label'=>'<i class="glyphicon glyphicon-book"></i> Preview',
        //when you change this line, don't remember about _content.php loading content
        'content'=> $model->chapter->chapter_content,
        'active'=>true,
        'linkOptions'=>['data-url'=>Url::to(['/book/write/' . $current_book_id . '/' . $current_chap_id . '/json-content'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Editor',
        'content'=>Url::to(['/book/write/' . $current_book_id . '/' . $current_chap_id . '/json-editor']),
        'linkOptions'=>['data-url'=>Url::to(['/book/write/' . $current_book_id . '/' . $current_chap_id . '/json-editor'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-wrench"></i> Settings',
        'content'=>Url::to(['/book/write/' . $current_book_id . '/' . $current_chap_id . '/json-settings']),
            'linkOptions'=>['data-url'=>Url::to(['/book/write/' . $current_book_id . '/' . $current_chap_id . '/json-settings'])]
    ],
];

foreach ($model->getChapterList() as $chap_id => $chap_title)
    {
        $items[$chap_id]['label'] = $chap_title;
        $items[$chap_id]['url'] = Url::to(['/book/write/' . $current_book_id . '/' . $chap_id . '/index']);
        $items[$chap_id]['active'] = ($chap_id == $current_chap_id);
    }
?>
<h1><?=$this->title?></h1>
<p><?= Html::a('[edit book]', ['/book/edit/' . $current_book_id . '/description']);?></p>


<div class="col-sm-2">

    <?php Modal::begin([
        'header' => '<h2>Add new chapter</h2>',
        'toggleButton' => ['label' => '+ Add new chapter', 'class' => 'btn btn-success'],
    ]);?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modelNewChap, 'chapter_title') ?>

    <?= $form->field($modelNewChap, 'book_id')->hiddenInput(['value' => $current_book_id])->label(false) ?>

    <?= $form->field($modelNewChap, 'chapter_id')->hiddenInput(['value' => $current_book_id])->label(false) ?>

    <div class="form-group" style="margin-top: 10px;">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Modal::end();?>

    <br /><br />

    <?=
    Nav::widget(
        [
            'options' => [
                'class' => ['nav nav-pills nav-stacked'],
            ],
            'activateItems' => true,
            'encodeLabels' => false,
            'items' => $items,
        ]
    );
    ?>
</div>
<div class="col-sm-10">

    <?=// Ajax Tabs Above
        TabsX::widget([
            'items'=>$tabItems,
            'position'=>TabsX::POS_ABOVE,
            'encodeLabels'=>false,
            //'id'=>'global_tabs'
        ]);
    ?>
</div>

