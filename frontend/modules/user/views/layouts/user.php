<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

    <div class="user-wrap">
        <?php
            \yii\bootstrap\NavBar::begin([
                'options' => [
                    'class' => 'navbar',
                    'id' => 'navbar-user',
                ],
            ]);
            $menuItems = [
                ['label' => 'Dashboard', 'url' => ['/user/dashboard/index']],
                ['label' => 'Inbox', 'url' => ['/user/inbox/index']],
                ['label' => 'Your books', 'url' => ['/user/books/index']],
                ['label' => 'Read', 'url' => ['#']],
                ['label' => 'Profile', 'url' => ['/user/profile/edit']],
                ['label' => 'Account', 'url' => ['#']],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => array_filter($menuItems),
            ]);
            NavBar::end();
        ?>
    </div>
    <?= $content ?>
    </div>
<?php $this->endContent(); ?>