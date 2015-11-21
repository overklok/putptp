<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model string */

//when you change this line, don't remember about index.php pre-loaded content
$model = !empty($model) ? $model : "There is still empty..."

?>

<div class="book-chapter-content">
    <?= $model; ?>
</div>
