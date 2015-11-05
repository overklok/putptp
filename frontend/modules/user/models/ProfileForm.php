<?php
namespace app\modules\user\models;

use common\modules\user\models\User;
use common\modules\user\models\UserSettings;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

/**
 * Profile form
 */
class ProfileForm extends Model
{
    public $user_first_name;
    public $user_middle_name;
    public $user_last_name;

    public $user_email;

    public $filename;

//    public $verifyCode;

    /**
     * @var UploadedFile
     */
    public $user_image;

    public function attributeLabels()
    {
        return [
            'user_image' => 'Your Profile Photo:',
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //добавить паттерны
            ['user_first_name', 'filter', 'filter' => 'trim'],
            ['user_first_name', 'required'],
            ['user_first_name', 'string', 'min' => 2, 'max' => 255],

            ['user_last_name', 'filter', 'filter' => 'trim'],
            ['user_last_name', 'required'],
            ['user_last_name', 'string', 'min' => 2, 'max' => 255],

            ['user_middle_name', 'filter', 'filter' => 'trim'],
            ['user_middle_name', 'string', 'min' => 2, 'max' => 255],
        /*
            ['user_email', 'filter', 'filter' => 'trim'],
            ['user_email', 'required'],
            ['user_email', 'email'],
            ['user_email', 'string', 'max' => 255],
            ['user_email', 'unique', 'targetClass' => '\common\modules\user\models\User', 'message' => 'This email address has already been taken.'],
        */
            [['user_image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['user_image', 'default', 'value' => '/upload/user/image/missing_user.png'],

        //    ['verifyCode', 'captcha', 'captchaAction' => '/svc/default/captcha'],
        ];
    }

    public function insertFromModel($model)
    {
        $this->user_first_name = $model->user_first_name;
        $this->user_last_name = $model->user_last_name;
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->user_image->baseName != '')
            {
                if (empty($this->filename))
                    $this->filename = self::getRandomFileName();

                $uploaddir = Yii::$app->params['uploadRoot'] . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR;
                $this->user_image->saveAs($uploaddir . $this->filename . '.' . $this->user_image->extension);
            }
            $this->user_image = $this->filename . $this->user_image->extension;
            return true;
        } else {
            return false;
        }
    }

    public function edit()
    {
        if ($settings = $this->populate()) {
            return $settings;
        }
        return null;
    }

    public function populate()
    {
        if ($this->validate())
        {
            //$user = User::findOne(Yii::$app->user->identity->getId());

            //$user->user_email = $this->user_email;
            //$user->generateEmailConfirmToken();

            //if ($user->update()) {
                $settings = UserSettings::findOne(Yii::$app->user->identity->getId());

                $settings->user_first_name = $this->user_first_name;
                //$user->user_middle_name = $this->user_middle_name;
                $settings->user_last_name = $this->user_last_name;


                if (empty($this->filename))
                    $this->filename = self::getRandomFileName();

                $settings->user_image_url = $this->filename . '.' . $this->user_image->extension;

                if ($settings->update())
                {
                    return $settings;
                }
            //}
        }
        return false;
    }

    public function getRandomFileName()
    {
        do {
            $name = substr(md5(microtime() . rand(0, 9999)), 0, 10);
        } while (UserSettings::findOne(['user_image_url' => $name]));

        return $name;
    }
}
