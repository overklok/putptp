<?php

namespace app\modules\book\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\users\models\User;

class Book extends \common\modules\book\models\Book
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

}