<?php

namespace app\modules\book\controllers;

use app\modules\book\models\CreateForm;
use yii\helpers\Url;
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
                return $this->redirect(Url::to('/book/edit/' . $book->book_id . '/description'));
            }
        }

        return $this->render('create', ['model' => $model]);
    }
}
