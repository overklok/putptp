<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        You cannot <i>create</i> new user.</p>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'user_name',
            //'user_auth_key',
            //'user_password_hash',
            //'user_password_reset_token',
             'user_email:email',
             'user_status',
             'user_image_url:url',
            [
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_from',
                    'attribute2' => 'date_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => ['format' => 'yyyy-mm-dd']
                ]),
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],

             'created_at:datetime',
             'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update}'],
        ],
     /*   'beforeRow' => function($model, $key, $index) {
            return  Html::tag('tr',
                    Html::tag('td', $model->father_name),
                    Html::tag('td', $model->father_dob),
                //add more columns
            );
        }*/
    ]); ?>

</div>
