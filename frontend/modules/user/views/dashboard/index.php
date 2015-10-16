<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\User */

    $this->title = empty($model->user_first_name) ? $model->user_name :
        $model->user_first_name . " " . $model->user_middle_name . " " . $model->user_last_name . ", ";


?>
    <div class="dashboard-index">

        <div class="row">
            <div class="col-md-3">
                <div class="user-pic-name text-center">
                    <?= Html::img('/' . Html::encode($model->settings->user_image_url), ['alt'=>$model->user_name, 'style'=>'width: 100%']);?>
                    <h2><?= Html::encode($model->user_last_name)?></h2>
                    <h4><?= Html::encode($model->user_first_name . ' ' . $model->user_middle_name)?></h4>

                    <?= Html::a('View Profile', Url::to('#')); ?>
                    <br />
                    <?= Html::a('Edit Profile', Url::to('#')); ?>
                </div>

            </div>
            <div class="col-md-7">

            </div>
        </div>

    </div>
