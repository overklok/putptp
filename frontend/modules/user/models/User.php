<?php

namespace frontend\modules\user\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\modules\user\models\UserSettings;

class User extends \common\modules\user\models\User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), []);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return $scenarios;
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
            return true;
        return false;
    }

    public function getSettings()
    {
        $settings = UserSettings::findOne($this->id);
        return $settings;
    }
}