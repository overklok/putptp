<?php

namespace common\modules\globals\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "currency".
 *
 * @property integer $currency_id
 * @property string $currency_name
 * @property string $currency_rate
 * @property string $currency_title
 * @property integer $updated_at
 *
 * @property BookSettings[] $bookSettings
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_name', 'currency_rate'], 'required'],
            [['currency_rate'], 'number'],
            [['currency_name'], 'string', 'max' => 3],
            [['currency_name'], 'unique'],
            [['currency_title'], 'string'],
            [['updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currency_id' => 'Currency ID',
            'currency_name' => 'Currency Name',
            'currency_rate' => 'Currency Rate',
            'currency_title' => 'Currency Title',
            'updated_at' => 'Update time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookSettings()
    {
        return $this->hasMany(BookSettings::className(), ['book_currency' => 'currency_id']);
    }
}
