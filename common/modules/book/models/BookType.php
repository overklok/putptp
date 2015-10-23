<?php

namespace common\modules\book\models;

use Yii;

/**
 * This is the model class for table "book_type".
 *
 * @property integer $book_type_id
 * @property string $book_type_name
 * @property string $book_type_title
 *
 * @property Book[] $book
 */
class BookType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_type_name'], 'required'],
            [['book_type_name'], 'string', 'max' => 255],
            [['book_type_title'], 'string', 'max' => 50],
            [['book_type_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_type_id' => 'Book Type ID',
            'book_type_name' => 'Book Type Name',
            'book_type_title' => 'Book Type Title',
        ];
    }

    public static function getTypeList()
    {
        $ar_list = BookType::find()->all();
        $list;

        foreach ($ar_list as $elem)
        {
            $list[$elem->book_type_id] = $elem->book_type_title;
        }

        return $list;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['book_type_id' => 'book_type_id']);
    }
}
