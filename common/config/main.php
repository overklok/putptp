<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'defaultRoute' => 'main/default/index',
    'modules' => [
        'globals' => [
            'class' => 'common\modules\globals\GlobalsModule',
        ],
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['user', 'moder', 'admin'],
            //'itemFile' => '@common/components/rbac/items.php',
            //'assignmentFile' => '@common/components/rbac/assignments.php',
            //'ruleFile' => '@common/components/rbac/rules.php'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],

];
