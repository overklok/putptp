<?php

namespace app\modules\user\controllers;

use app\modules\user\models\ProfileForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use frontend\modules\user\models\User;
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
     //   echo is_writable('files/uploads/user/image/');
     //   exit();

        $this->layout = 'user';

        $model = new ProfileForm();

        $modelPop = $this->findModel();

        if ($model->load(Yii::$app->request->post()))
        {
            $model->user_image = UploadedFile::getInstance($model, 'user_image');
            if ($user = $model->edit())
            {
                $model->upload();
                Yii::$app->getSession()->setFlash('success', 'Profile settings successfully updated.');
                    return $this->redirect('/user/profile/edit');

            }
        }

        $model->insertFromModel($modelPop);

        return $this->render('edit', ['model' => $model
        ]);
    }

    public function beforeRender()
    {

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
