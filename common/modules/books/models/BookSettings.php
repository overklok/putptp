<?php

namespace common\modules\books\models;

use Yii;

/**
 * This is the model class for table "book_settings".
 *
 * @property integer $book_id
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'book_set_f1', 'book_set_f2', 'created_at', 'updated_at'], 'required'],
            [['book_id', 'book_set_f1', 'book_set_f2', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
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
