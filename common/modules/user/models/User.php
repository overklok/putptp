<?php
namespace common\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;
use yii\web\IdentityInterface;

/**
 * Модель пользователя
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $user_auth_key
 * @property string $user_password_hash
 * @property string $user_password_reset_token
 * @property string $user_email
 * @property integer $status
 * @property string $user_image_url
 * @property string $user_DOB
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    //Роли
    const ROLE_USER = 1;
    const ROLE_MODER = 5;
    const ROLE_ADMIN = 3;
    //Статусы пользователя
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_name', 'required'],
            ['user_name', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['user_name', 'unique', 'targetClass' => self::className(), 'message' => 'This username has already been taken.'],
            ['user_name', 'string', 'min' => 2, 'max' => 255],

            ['user_email', 'required'],
            ['user_email', 'email'],
            ['user_email', 'unique', 'targetClass' => self::className(), 'message' => 'This email address has already been taken.'],
            ['user_email', 'string', 'max' => 255],

            ['user_status', 'integer'],
            ['user_status', 'default', 'value' => self::STATUS_ACTIVE],
            ['user_status', 'in', 'range' => array_keys(self::getStatusesArray())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'created_at' => 'Create time',
            'updated_at' => 'Update time',
            'user_name' => 'User name',
            'user_email' => 'Email',
            'user_status' => 'Status',
        ];
    }


    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->user_status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Locked',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_WAIT => 'Waiting for a confirm',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id, 'user_status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['user_name' => $username, 'user_status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'user_password_reset_token' => $token,
            'user_status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->user_auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->user_password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->user_password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->user_auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->user_password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->user_password_reset_token = null;
    }

    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['user_email_confirm_token' => $email_confirm_token, 'user_status' => self::STATUS_WAIT]);
    }

     /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->user_email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->user_email_confirm_token = null;
    }

}