<?php

namespace app\modules\user\controllers;

use yii\web\NotFoundHttpException;
use frontend\modules\user\models\User;
use yii\web\Controller;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'user';
        return $this->render('index', ['model' => $this->findModel(\Yii::$app->user->id), '']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
