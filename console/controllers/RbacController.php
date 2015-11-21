<?php

namespace console\controllers;

use common\modules\user\models\User;
use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        //Запуск компонента (интерфейс ManagerInterface)
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //Удалить старые данные (авторизации, роли, правила, разрешения и присвоения)
        $dashboard = $auth->createPermission('dashboard'); //создание объекта Permission
        $dashboard->description = 'Admin control panel';   //подкл. к системе RBAC разрешения
        $auth->add($dashboard);

        //Подкл. обработчик
        $rule = new UserRoleRule();
        $auth->add($rule);

        //Доб. роли
        $user = $auth->createRole('user');
        $user->description = 'End user';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $moder = $auth->createRole('moder');
        $moder->description = 'Moderator';
        $moder->ruleName = $rule->name;
        $auth->add($moder);

        //Создание дочерних отношений
        $auth->addChild($moder, $user);      //отношение роли к роли
        $auth->addChild($moder, $dashboard); //отношение прав доступа к роли

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        $auth->addChild($admin, $moder);

        echo 'All roles successfully created!';
    }

    public function actionMkadmin()
    {
        $rbac = \Yii::$app->authManager;

        $admin = $rbac->getRole('admin');

        $rbac->assign(
            $admin,
            User::findOne(['user_name' => 'admin'])->user_id
        );
    }

    public function actionMkmoder()
    {
        $rbac = \Yii::$app->authManager;

        $admin = $rbac->getRole('moder');

        $rbac->assign(
            $admin,
            User::findOne(['user_name' => 'sanekmolodoy'])->user_id
        );
    }
}