<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([

        'brandLabel' => 'Put Pen To Paper',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            'id' => 'navbar-main',
        ],
    ]);
    $menuItems = [
        ['label' => 'Start reading', 'url' => ['/main/default/index']],
        ['label' => 'Start writing', 'url' => ['/book/create']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/svc/default/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/svc/default/login']];
    } else {
        $menuItems[] = [
            'label' => empty(Yii::$app->user->identity->settings->user_first_name) ? Yii::$app->user->identity->user_name : Yii::$app->user->identity->settings->user_first_name . ' ' . Yii::$app->user->identity->settings->user_last_name,
            'items' => [
                    [
                        'label' => 'Dashboard',
                        'url' => '/user/dashboard/index',
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

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
            <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

        <p class="pull-left">&copy; Put Pen To Paper <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
