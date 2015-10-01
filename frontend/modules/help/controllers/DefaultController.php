<?php

namespace app\modules\help\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
