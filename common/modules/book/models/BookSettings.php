<?php

namespace common\modules\book\models;

use Symfony\Component\Finder\Expression\Expression;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book_settings".
 *
 * @property integer $book_id
 * @property string $book_images_cat
 * @property integer $book_cover
 * @property string $book_desc_problem
 * @property string $book_desc_characters
 * @property integer $book_set_f1
 * @property integer $book_set_f2
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Book $book
 */
class BookSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_settings';
    }

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
            [['book_id'],  'required'],
            [['book_id', 'book_set_f1', 'book_set_f2', 'created_at', 'updated_at'], 'integer'],
            [['book_cover'], 'integer'],
            [['book_images_cat'], 'string', 'max' => 10],
            [['book_desc_problem'], 'string', 'max' => 35],
            [['book_desc_characters'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_images_cat' => 'Book Images Cat',
            'book_cover' => 'Book Cover',
            'book_desc_problem' => 'Book Desc Problem',
            'book_desc_characters' => 'Book Desc Characters',
            'book_set_f1' => 'Book Set F1',
            'book_set_f2' => 'Book Set F2',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }
}
