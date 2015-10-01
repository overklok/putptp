<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $user_name;
    public $user_first_name;
    public $user_middle_name;
    public $user_last_name;

    public $user_email;
    public $user_password;

    /**
     * @var UploadedFile
     */
    public $user_image;
    public $user_DOB;

    public function attributeLabels()
    {
        return [
            'user_DOB' => 'Date of Birth:',
            'user_image' => 'Your Profile Photo:',
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_name', 'filter', 'filter' => 'trim'],
            ['user_name', 'required'],
            ['user_name', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            ['user_first_name', 'filter', 'filter' => 'trim'],
            ['user_first_name', 'required'],
            ['user_first_name', 'string', 'min' => 2, 'max' => 255],

            ['user_first_name', 'filter', 'filter' => 'trim'],
            ['user_last_name', 'required'],
            ['user_last_name', 'string', 'min' => 2, 'max' => 255],

            ['user_middle_name', 'filter', 'filter' => 'trim'],
            ['user_middle_name', 'string', 'min' => 2, 'max' => 255],

            ['user_email', 'filter', 'filter' => 'trim'],
            ['user_email', 'required'],
            ['user_email', 'email'],
            ['user_email', 'string', 'max' => 255],
            ['user_email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['user_password', 'required'],
            ['user_password', 'string', 'min' => 6],

            ['user_DOB', 'required'],
            ['user_DOB', 'date', 'format' => 'MM/dd/yyyy'],

            [['user_image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['user_image', 'default', 'value' => 'uploads/user/image/missing_user.png']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->user_name = $this->user_name;
            $user->user_first_name = $this->user_first_name;
            $user->user_middle_name = $this->user_middle_name;
            $user->user_last_name = $this->user_last_name;
            $user->user_email = $this->user_email;
            $user->setPassword($this->user_password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->user_image->saveAs('uploads/user/image' . $this->user_image->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
