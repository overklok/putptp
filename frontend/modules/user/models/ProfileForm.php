<?php
namespace app\modules\user\models;
use common\modules\user\models\UserSettings;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
/**
 * Profile form
 */
class ProfileForm extends Model
{
    /**
     * @var string
     */
    public $user_first_name;
    /**
     * @var string
     */
    public $user_last_name;
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
            [['user_image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['user_image', 'default', 'value' => Yii::$app->params['user_default_image']],
            //    ['verifyCode', 'captcha', 'captchaAction' => '/svc/default/captcha'],
        ];
    }

    /*
     * Загрузить все текущие данные для автозаполнения формы
     * @var $model common/modules/user/models/UserSettings
     */
    public function downloadAll($model)
    {
        $this->user_first_name = $model->user_first_name;
        $this->user_last_name = $model->user_last_name;
        if ($this->user_image = $this->downloadFile($model->user_image_url))
            return $this;
        else
            return false;
    }

    /*
     * Отправление всех редактируемых данных профиля на сервер
     * @var $model common/modules/user/models/UserSettings
     */
    public function uploadAll($model)
    {
        $model->user_first_name = $this->user_first_name;
        $model->user_last_name = $this->user_last_name;

        if ($this->validate())
        {
            if ($this->user_image != Yii::$app->params['user_default_image'])
                $model->user_image_url = $this->uploadFile(self::newRandomFileName());

            if ($model->update())
                return true;
        }

        return false;
    }

    /*
     * Загрузка файла с сервера
     * @var string $filename имя файла на сервере
     * return полный путь хранения
     */
    public function downloadFile($filename)
    {
        $download_path = //Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . '..' .
                         '/' . Yii::$app->params['uploadRoot'] . '/' . 'user' .
                                                                 '/' . 'image'.
                                                                 '/' . $filename;
        //if(file_exists($download_path))
            return $download_path;
//        else
      //      return false;
    }

    /*
     * Загрузка файла на сервер
     * @var string $filename имя файла для хранения на сервере
     */
    public function uploadFile($filename)
    {
        $fullname = $filename . '.' . $this->user_image->extension;
        $upload_path =  Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
                        Yii::$app->params['uploadRoot'] .DIRECTORY_SEPARATOR . 'user' .
                                                         DIRECTORY_SEPARATOR . 'image' .
                                                         DIRECTORY_SEPARATOR . $fullname;
        if ($this->user_image->error == 0)
        {
            $this->user_image->saveAs($upload_path);
            return $fullname;
        }

        return null;
    }

    public static function removeFile($model)
    {
        $filename = $model->user_image_url;
        $remove_path = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
            Yii::$app->params['uploadRoot'] . DIRECTORY_SEPARATOR . 'user' .
                                              DIRECTORY_SEPARATOR . 'image'.
                                              DIRECTORY_SEPARATOR . $filename;
        if(file_exists($remove_path))
        {
            $model->user_image_url = Yii::$app->params['user_default_image'];
            if ($filename == Yii::$app->params['user_default_image'])
                return true;
            if (unlink($remove_path) && $model->update())
                return true;
            else
                return false;
        }

        return true;
    }

    /*
     * Генерация свободного md5-имени в БД
     */
    public static function newRandomFileName()
    {
        do {
            $name = substr(md5(microtime() . rand(0, 9999)), 0, 10);
        } while (UserSettings::findOne(['user_image_url' => $name]));
        return $name;
    }
}
