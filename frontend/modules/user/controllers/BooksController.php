<?php

namespace app\modules\user\controllers;

use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use common\modules\book\models\Book;
use yii\web\Controller;
use Yii;

class BooksController extends Controller
{
    public function actionIndex()
    {
        $this->layout = 'user';

        $query = Book::find()->where(['author_id' => Yii::$app->user->identity->getId()]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

}
