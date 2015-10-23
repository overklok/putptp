<?php

namespace app\modules\book\controllers;

use app\modules\book\models\CreateForm;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    public function actionCreate()
    {
        $model = new CreateForm();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($book = $model->createBook())
            {
                return $this->goHome();
            }
        }

        return $this->render('create', ['model' => $model]);
    }
}
