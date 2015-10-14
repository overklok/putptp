<?php

namespace common\components\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\modules\user\models\User;

//Обработчик User
class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $roles = Yii::$app->authManager->getRolesByUser($user);

            if ($item->name === 'admin')
            {
                return isset($roles[$item->name]);
            }
            elseif ($item->name === 'moder')
            {
                return isset($roles[$item->name]) || isset($roles['admin']);
            }
            elseif ($item->name === 'user')
            {
                return isset($roles[$item->name]) || isset($roles['moder']) || isset($roles['admin']);
            }

        }
        return false;
    }
}