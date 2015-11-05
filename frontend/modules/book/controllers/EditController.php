<?php

namespace app\modules\book\controllers;

use app\modules\book\models\Book;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;

class EditController extends Controller
{
    public $bookTitle;

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

        $this->bookTitle = $model->book_title;

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

        $this->bookTitle = $model->book_title;

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

        $this->bookTitle = $model->book_title;

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

    public function actionDetDescription($id)
    {
        $this->layout = 'edit';

        $model = $this->findModel($id);

        $this->bookTitle = $model->book_title;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->refresh();
        }
        else
        {
            return $this->render('det-description', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) === null) {
            throw new BadRequestHttpException('This book does not exist.');
        }
        elseif (Book::findOne($id)->author_id != Yii::$app->user->identity->getId())
        {
            throw new Exception("You have not access to this action.");
        }
        else {
            return $model;
        }
    }
}

