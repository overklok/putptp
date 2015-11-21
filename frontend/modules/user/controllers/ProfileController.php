<?php

namespace app\modules\user\controllers;

use app\modules\user\models\ProfileForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use common\modules\user\models\UserSettings;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProfileController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'removeImg' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        //  $this->layout = 'user';
        //  return $this->render('index', ['model' => $this->findModel(Yii::$app->user->id), '']);
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEdit()
    {
        $this->layout = 'user';

        $modelPop = $this->findModel();

        $model = new ProfileForm();
        $settings = UserSettings::findOne(Yii::$app->user->identity->getId());

        if($model->load(Yii::$app->request->post()))
        {
            $model->user_image = UploadedFile::getInstance($model, 'user_image');

            //ЕСЛИ загружается новое фото И старое не удаляется успешно
            if($model->user_image != null && !$model->removeFile($settings))
            {
                Yii::$app->getSession()->setFlash('danger', 'Something went wrong...');
                return $this->redirect('/user/profile/edit');
            }

            if (!$model->user_image->error && $model->validate() && $model->uploadAll($settings))
            {
                Yii::$app->getSession()->setFlash('success', 'Profile settings successfully updated.');
                return $this->redirect('/user/profile/edit');
            }

            Yii::$app->getSession()->setFlash('danger', 'Something went wrong...');
            return $this->redirect('/user/dashboard');
        }

        $model->downloadAll($modelPop);

        return $this->render('edit', ['model' => $model]);
    }

    public function actionRemoveImg()
    {
        $this->layout = 'user';

        $settings = UserSettings::findOne(Yii::$app->user->identity->getId());

        if ($settings->user_image_url == Yii::$app->params['user_default_image'])
        {
            Yii::$app->getSession()->setFlash('warning', 'Image removed already');
            $this->redirect('/user/profile/edit');
        }

        $settings->user_image_url = Yii::$app->params['user_default_image'];

        if (!(ProfileForm::removeFile($settings) && $settings->update()))
        {
            Yii::$app->getSession()->setFlash('danger', 'Cannot remove image...');
            $this->redirect('/user/profile/edit');
        }

        $this->redirect('/user/profile/edit');
    }

    protected function findModel()
    {
        if (($model = UserSettings::findOne(Yii::$app->user->identity->getId())) !== null)
        {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
