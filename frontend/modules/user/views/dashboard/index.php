<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\modules\user\models\User */

    $this->title = empty($model->settings->user_first_name) ? $model->user_name :
        $model->settings->user_first_name . " " . $model->settings->user_last_name;

    $name = empty($model->settings->user_first_name) ? $model->user_name : $model->settings->user_first_name;
    $user_img = '/uploads/user/image/' . $model->settings->user_image_url;

?>
    <div class="dashboard-index" style="background-color: #bbbbbb">
        <div class="row">
            <div class="col-sm-3">
                <div class="user-pic-name text-center">
                    <?= Html::img(Html::encode($user_img), ['alt'=>$model->user_name, 'style'=>'width: 100%']);?>

                    <h2><?= Html::encode($name); ?></h2>

                    <?= Html::a('View Profile', Url::to('#')); ?>
                    <br />
                    <?= Html::a('Edit Profile', Url::to('/user/profile/edit')); ?>
                </div>

            </div>
            <div class="col-sm-7">

            </div>
        </div>
    </div>
