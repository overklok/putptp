<?php

namespace app\modules\book\controllers;

use common\modules\book\models\Book;
use common\modules\book\models\BookIll;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;
use yii\web\HttpException;
use yii\web\UploadedFile;

class IllController extends Controller
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

    public function actionUpload($id, $cover = false)
    {
        if (empty($_FILES['file']))
        {
            echo json_encode(['error' => 'No files found for upload']);
            //exception
            return;
        }

        $files = $_FILES['file'];
        $filenames = $files['name'];
        $success = null;
        $paths = [];

        $book = Book::findOne($id);

        if($book->author_id != Yii::$app->user->identity->getId())
            throw new HttpException(401, "You have not access to this action.");

        $folder = Yii::$app->params['uploadRoot'] . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $book->settings->book_images_cat;

        if (!file_exists($folder))
        {
            mkdir($folder, 0777, true);
        }

        for($i=0; $i < count($filenames); $i++)
        {
            $model = new BookIll();

            if ($success = $model->upload($id, $files['tmp_name'][$i], $filenames[$i], $folder, $cover) !== false)
            {
                $paths[] = $success;
            }
            else
            {
                break;
            }
        }

        if($success === true)
        {
            $output = ['success' => 'File uploaded'];
            //list of uploaded this way: $output = ['uploaded' => $paths];
        }
        elseif ($success === false)
        {
            $output = ['error' => 'Error while uploading images. Contact the system administrator.'];

            foreach($paths as $file)
            {
                unlink($file);
            }
        }

        else
        {
            $output = ['error' => 'No files were processed.'];
        }

        if(!empty($model->errors['error'])) {
            $output = ['error' => $model->errors['error']];
        }

        return json_encode($output);
    }

    public function actionDelete()
    {

    }

    public function actionUploadIllustration()
    {
        $model = new BookIll();

        if ($model->load(Yii::$app->request->post()))
        {
            if ($book = $model->createBookIll())
            {
                return $this->redirect(Url::to('/book/edit/' . $book->book_id . '/description'));
            }
        }

        return $this->render('create', ['model' => $model]);
    }
}
