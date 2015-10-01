<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->user_name;
?>
<div class="user-view">

    <h1>User: <?= Html::encode($model->user_last_name)?>, <?= Html::encode($model->user_first_name) ?> <?= Html::encode($model->user_middle_name) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'user_name',
            //'user_auth_key',
            //'user_password_hash',
            //'user_password_reset_token',
            'user_email:email',
            'user_status',
            'user_image_url:url',
            'user_DOB',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
