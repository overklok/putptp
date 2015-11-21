<?php

namespace app\modules\book\controllers;

use common\modules\book\models\Book;
use common\modules\book\models\BookChapter;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use Yii;

class WriteController extends \yii\web\Controller
{
    public function actionIndex($id, $chap = 0)
    {
        $modelNewChap = $this->newChapModel($id);
        $modelNewChap->book_id = $id;

        if ($chap == 0)
            $chap = $modelNewChap->firstChapter();

        if($modelNewChap->load(Yii::$app->request->post()))
        {
            if ($modelNewChap->addChapter() && !$modelNewChap->save())
                Yii::$app->getSession()->setFlash('danger', 'Error while creating new chapter');
            else
                Yii::$app->getSession()->setFlash('success', 'New chapter successfully created');

            $this->refresh();
        }

        $model = $this->findBookModel($id);
        $model->chapterId = $chap;

        if (!$model->isChaptersExists() && !$model->chapterId = $modelNewChap->addChapter() && $modelNewChap->save())
            throw new \ErrorException("The server has a problem");

        //var_dump($model->chapter_id); exit();

        if (!$model->chapter)
            throw new BadRequestHttpException("This chapter is not exist");

        //var_dump($model->chapter); exit();

        return $this->render('index', ['model' => $model, 'modelNewChap' => $modelNewChap]);
    }

    public function actionJsonEditor($id, $chap)
    {
        $model = BookChapter::findOne(['book_id' => $id, 'chapter_id' => $chap]);

        if($model->load(Yii::$app->request->post()))
        {
            if(!$model->save())
                Yii::$app->getSession()->setFlash('danger', 'Error while saving this chapter');
            else
                Yii::$app->getSession()->setFlash('success', 'Chapter successfully saved');

            $this->redirect('/book/write/' . $id . '/' . $chap . '/index#w3-tab1');
        }
        $html = $this->renderAjax('_editor', ['model' => $model]);
/*
        $this->registerJs("$(document).ready(function() {
                setTimeout(function() {
                    $('#global_tabs a:first').trigger('click');
                },10);
            });");

        if(!empty($model->errors['error']))
            $html = ['error' => $model->errors['error']];
*/
        //var_dump($_POST);
        return Json::encode($html);
    }

    public function actionJsonContent($id, $chap)
    {
        $model = $this->findBookModel($id);
        $model->chapterId = $chap;

        $html = $this->renderAjax('_content', ['model' => $model->chapter->chapter_content]);
        return Json::encode($html);
    }

    public function actionJsonSettings($id, $chap)
    {
        $model = $this->findChapModel($id, $chap);

        if($model->load(Yii::$app->request->post()))
        {
            if(!$model->save())
                Yii::$app->getSession()->setFlash('danger', 'Error while saving this chapter');
            else
                Yii::$app->getSession()->setFlash('success', 'Chapter successfully saved');

            $this->redirect('/book/write/' . $id . '/' . $chap . '/index#w3-tab1');
        }

        $html = $this->renderAjax('_settings', ['model' => $model]);
        return Json::encode($html);
    }

    protected function findBookModel($id)
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
    //Лучше бы так не делать!
    protected function findChapModel($id, $chap)
    {
        if (($model = BookChapter::findOne(['book_id' => $id, 'chapter_id' => $chap])) === null) {
            throw new BadRequestHttpException('This book or chapter does not exist.');
        }
        elseif (Book::findOne($id)->author_id != Yii::$app->user->identity->getId())
        {
            throw new Exception("You have not access to this action.");
        }
        else {
            return $model;
        }
    }

    protected function newChapModel($id)
    {
        if ((Book::findOne($id)) === null) {
            throw new BadRequestHttpException('This book does not exist.');
        }
        elseif (Book::findOne($id)->author_id != Yii::$app->user->identity->getId())
        {
            throw new Exception("You have not access to this action.");
        }
        else {
            return new BookChapter();
        }
    }
}
