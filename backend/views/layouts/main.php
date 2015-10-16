<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
        'brandLabel' => 'Put Pen To Paper CMS',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'HOME', 'url' => ['/main/default/index']],
        Yii::$app->user->isGuest ?
            ['label' => 'LOGIN', 'url' => ['/user/default/login']] :
            false,
        (Yii::$app->user->can('moder') && !Yii::$app->user->can('admin'))?
            ['label' => 'MODERATION',
                'items' => [
                    [
                        'label' => 'USERS CONTROL',
                        'url' => ['/users/moder/index'],
                    ],
                    [
                        'label' => 'BOOKS CONTROL',
                        'url' => ['/book/moder/index'],
                    ],
                ]
            ] :
        false,
        Yii::$app->user->can('admin') ?
            ['label' => 'ADMINISTRATION',
                'items' => [
                    [
                        'label' => 'USERS CONTROL',
                        'url' => ['/users/moder/index'],
                    ],
                    [
                        'label' => 'BOOKS CONTROL',
                        'url' => ['/book/moder/index'],
                    ],
                    [
                        'label' => 'ACCESS RIGHTS MANAGEMENT',
                        'url' => ['/rbac/moder/index']
                    ],
                    [
                        'label' => 'USER PROFILING MANAGEMENT',
                        'url' => ['/profiling/moder/index']
                    ]
                ]
            ] :
        false,

        !Yii::$app->user->isGuest ?
            ['label' => 'CMS SETTINGS'] : false,

        !Yii::$app->user->isGuest ?
        [
            'label' => 'LOGOUT (' . Yii::$app->user->identity->user_name . ')',
            'url' => ['/user/default/logout'],
            'linkOptions' => ['data-method' => 'post']
        ] :
        false,
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'activateParents' => true,
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
        <p class="pull-left">&copy; PutPTP CMS version Pre-Alpha <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
