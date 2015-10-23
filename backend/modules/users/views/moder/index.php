<?php

use yii\helpers\Html;
use \kartik\date\DatePicker;
use yii\grid\GridView;
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\users\models\User;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\user\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users Control';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?=
        Nav::widget(
        [
            'options' => [
                'class' => ['nav nav-pills nav-stacked col-lg-2'],
            ],
            'items' => [
                [
                'label' => 'Main Information',
                'url' => ['/users/moder/index'],
                ],
                [
                    'label' => 'Settings',
                    'url' => ['/users/moder/settings'],
                ],
            ],

        ]
    )
    ?>

<div class="user-index col-lg-10">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Block Unconfirmed', ['set-blocked'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Clean Blocked!', ['delete-blocked'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            [
                'class' => LinkColumn::className(),
                'attribute' => 'user_name',
                'module' => 'users',
            ],
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
            [
                'filter' => User::getStatusesArray(),
                'attribute' => 'user_status',
                'class' => 'app\components\grid\StatusColumn',
            ],
            [
                'attribute' => 'user_first_name',
                'label' => 'First name',
            ],
            //'user_middle_name',
            [
                'attribute' => 'user_last_name',
                'label' => 'Last name',
            ],
            //'age',
             'user_DOB',
             //'updated_at',
            /*
            [
            'class' => ActionColumn::className(),
            ],*/
        ],
    ]); ?>



</div>
