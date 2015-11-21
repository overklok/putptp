<?php

namespace app\modules\books\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\users\models\User;

class Book extends \common\modules\book\models\Book
{
    const SCENARIO_ADMIN_CREATE = 'adminCreate';
    const SCENARIO_ADMIN_UPDATE = 'adminUpdate';

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

    public function getAuthorNameById($id)
    {
        $user = User::findOne($id);
        return $user->user_name;
    }

}