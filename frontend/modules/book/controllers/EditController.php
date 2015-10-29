<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

class EditController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

    public function actionGenre($id)
    {
        $this->layout = 'edit';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->refresh();
        }
        else
        {
            return $this->render('genre', [
                'model' => $model,
            ]);
        }
    }

    public function actionDescription($id)
    {
        $this->layout = 'edit';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->refresh();
        }
        else
        {
            return $this->render('description', [
                'model' => $model,
            ]);
        }
    }

    public function actionIllustration($id)
    {
        $this->layout = 'edit';

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->refresh();
        }
        else
        {
            return $this->render('illustration', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new BadRequestHttpException('This book does not exist.');
        }
    }
}
