<?php

namespace app\modules\users\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\modules\user\models\UserSettings;

class User extends \common\modules\user\models\User
{
    const SCENARIO_ADMIN_CREATE = 'adminCreate';
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate';

    public $newPassword;
    public $newPasswordRepeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['newPassword', 'newPasswordRepeat'], 'required', 'on' => self::SCENARIO_ADMIN_CREATE],
            ['newPassword', 'string', 'min' => 6],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword'],
        ]);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ADMIN_CREATE] = ['user_name', 'user_email','user_status', 'newPassword','newPasswordRepeat'];
        $scenarios[self::SCENARIO_ADMIN_UPDATE] = ['user_name', 'user_status'];
        return $scenarios;
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'newPassword' => 'New Password',
            'newPasswordRepeat' => 'Repeat Password',
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if (!empty($this->newPassword)) {
                $this->setPassword($this->newPassword);
            }
            return true;
        }
        return false;
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            $settings = UserSettings::findOne(['user_id' => $this->user_id]);
            if ($settings && $settings->delete())
                return true;
        }
        return false;
    }

    public static function changeStatus($from, $to)
    {
        $users = User::findAll(['user_status' => $from]);

        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $user->user_status = $to;
                $user->save();
            }
            return true;
        }

        return false;
    }

    public static function deleteWithStatus($status)
    {
        $users = User::findAll(['user_status' => $status]);

        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $user->delete();
            }
            return true;
        }

        return false;
    }

}