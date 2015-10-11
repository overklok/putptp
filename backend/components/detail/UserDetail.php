<?php

namespace app\components\detail;

use yii\helpers\Html;
use app\modules\users\models\User;

class UserDetail
{
    public static function getAttributes($model)
    {
        return [
            [
                'group' => true,
                'label' => 'Identification Information',
                'rowOptions' => ['class' => 'info']
            ],
            'user_id',
            'user_name',
            //    'user_first_name',
            //    'user_middle_name',
            //    'user_last_name',
            //    'user_auth_key',
            //    'user_password_hash',
            //    'user_password_reset_token',
            'user_email:email',
            //    'user_email_confirm_token:email',
            'user_DOB:datetime',
            [
                'group' => true,
                'label' => 'Moderation Information',
                'rowOptions' => ['class' => 'info']
            ],
            [
                'filter' => User::getStatusesArray(),
                'attribute' => 'user_status',
                'label' => 'Status',
                'format' => 'raw',
                'value' => $model->getStatusName(),
            ],
            [
                'group' => true,
                'label' => 'DB Information',
                'rowOptions' => ['class' => 'info']
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ];
    }
}