<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use \yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\themes\prod\assets\ProdAsset;
use common\widgets\Alert;

ProdAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="здесь, будут, ключевые слова">
    <meta name="description" content="Здесь описание страницы которое будет под сслыкой в поиске">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([

        'brandLabel' =>     '<div class="p_nav_logo">' .
                                Html::img('/images/logo.png', ['class' => 'p_img-nav_logo', 'alt'=>Yii::$app->name]) .
                                '<span class="p_title-nav_logo">Put Pen To Paper</span>' .
                            '</div>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'p_navbar navbar-inverse navbar-fixed-top',
            'id' => 'navbar-main',
        ],
    ]);
    $menuItems = [
        ['label' => 'Start reading', 'url' => ['/main/default/index']],
        ['label' => 'Start writing', 'url' => ['/book/create']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/svc/default/signup']];
        /*$menuItems[] = ['label' => 'Login', 'url' => ['/svc/default/login']];*/
        $menuItems[] = Html::button('Log in', ['value' => '/login', 'class' => 'btn btn-success', 'id' => 'modalLogin-button']);
    } else {
        $menuItems[] = [
            'label' => empty(Yii::$app->user->identity->settings->user_first_name) ? Yii::$app->user->identity->user_name : Yii::$app->user->identity->settings->user_first_name . ' ' . Yii::$app->user->identity->settings->user_last_name,
            'items' => [
                    [
                        'label' => 'Dashboard',
                        'url' => '/user/dashboard/index',
                    ],
                    [
                        'label' => 'My books',
                        'url' => '/user/books/index',
                    ],
                    [
                        'label' => 'Profile',
                        'url' => '/user/profile/edit',
                    ],
                    [
                        'label' => 'Logout',
                        'url' => ['/svc/default/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
            ],
        ];
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-envelope"></span>', 'url' => '#'];
        $menuItems[] = [
            'label' => 'Help',
            'items' => [
                    ['label' => 'About','url' => ['/help/default/index']],
                    ['label' => 'Contact', 'url' => ['/main/contact/index']],
            ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => array_filter($menuItems),
    ]);
    NavBar::end();
    ?>

    <div class="container p_container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget(['class' => 'p_alert']) ?>
            <?= $content ?>
    </div>
</div>
<!--
<footer class="p_footer">

    <div class="row">
        <div class="col-sm-offset-2 col-sm-2">

        </div>
        <div class="col-sm-2">

        </div>
        <div class="col-sm-2">

        </div>
    </div>

</footer>
-->
<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>

<?php
    Modal::begin([
        'header' => '<h4>Log in</h4>',
        'id' => 'modalLogin',
        'size' => 'modal-lg'
    ]);

    echo "<div id='modalLogin-content'></div>";

    Modal::end();
?>



