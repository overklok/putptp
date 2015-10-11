<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="main-default-index">

    <div class="jumbotron">
        <h1>Приветствуем!</h1>

        <p class="lead">Вы на главной странице Put Pen To Paper CMS.<br /> Выберите модуль управления:</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h2>Users Moderation Features</h2>
                <p><a class="btn btn-default" href="<?= Url::toRoute('/users/moder'); ?>">Users &raquo;</a></p>
            </div>
            <div class="col-lg-6">
                <h2>Book Moderation Features</h2>
                <p><a class="btn btn-default" href="<?= Url::toRoute('/books/moder'); ?>">Books &raquo;</a></p>
            </div>

        </div>
    </div>
</div>
