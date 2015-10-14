<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="main-default-index">

    <div class="jumbotron">
        <h1>This is <i>pptp</i> Control Panel.</h1>
        <p class="lead">Here is a little bit of features:</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <h2>Users Moderation</h2>
                <p><a class="btn btn-default" href="<?= Url::toRoute('/users/moder'); ?>">Users &raquo;</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <h2>Book Moderation</h2>
                <p><a class="btn btn-default" href="<?= Url::toRoute('/books/moder'); ?>">Books &raquo;</a></p>
            </div>
        </div>
    </div>
</div>
