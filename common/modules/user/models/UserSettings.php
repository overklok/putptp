<?php

namespace common\modules\user\models;

use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "user_settings".
 *
 * @property integer $user_id
 * @property integer $user_set_f1
 * @property integer $user_set_f2
 * @property string $user_image_url
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class UserSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],

            ['user_first_name', 'string', 'max' => 50],

            ['user_middle_name', 'string', 'max' => 50],

            ['user_last_name', 'string', 'max' => 50],

            [['user_image_url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_set_id' => 'User ID',
            'user_set_f1' => 'User Set F1',
            'user_set_f2' => 'User Set F2',
            'user_image_url' => 'User Image Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    public function deleteImage()
    {
        if (empty($this->user_image_url))
            return false;

        if (unlink( '/' . Yii::$app->params['uploadRoot'] . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'image' .
            DIRECTORY_SEPARATOR . $this->user_image_url))
            return false;

        $this->user_image_url = '';

        if (!$this->save())
            return false;

        return true;
    }
}
