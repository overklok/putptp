<?php
namespace frontend\modules\user\models;

use common\modules\user\models\User;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $user_email;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_email', 'filter', 'filter' => 'trim'],
            ['user_email', 'required'],
            ['user_email', 'email'],
            ['user_email', 'exist',
                'targetClass' => '\common\modules\user\models\User',
                'filter' => ['user_status' => \common\modules\user\models\User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user \common\modules\user\models\User */
        $user = \common\modules\user\models\User::findOne([
            'user_status' => \common\modules\user\models\User::STATUS_ACTIVE,
            'user_email' => $this->user_email,
        ]);

        if ($user) {
            if (!\common\modules\user\models\User::isPasswordResetTokenValid($user->user_password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
                    ->setTo($this->user_email)
                    ->setSubject('Password reset for ' . \Yii::$app->name)
                    ->send();
            }
        }

        return false;
    }
}
