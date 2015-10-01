<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . ' ' . $model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_name, 'url' => ['view', 'id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1>Update User: <?= Html::encode($model->user_last_name)?>, <?= Html::encode($model->user_first_name) ?> <?= Html::encode($model->user_middle_name) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
