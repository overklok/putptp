<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class WatchController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['guest'],
                    ],
                ],
            ],
        ];
    }


}