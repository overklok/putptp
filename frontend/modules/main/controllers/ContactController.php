<?php
namespace app\modules\main\controllers;

use app\modules\main\models\ContactForm;
use yii\web\Controller;
use Yii;

class ContactController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ContactForm();

        if ($user = Yii::$app->user->identity)
        {
            /** @var \frontend\modules\user\models\User $user */
            $model->name = $user->user_name;
            $model->email = $user->user_email;
        }

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail']))
        {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}