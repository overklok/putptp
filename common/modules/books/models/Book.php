<?php

namespace common\modules\books\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $book_id
 * @property integer $author_id
 * @property integer $book_type_id
 * @property integer $genre_id
 * @property string $book_title
 * @property string $book_description
 * @property integer $book_status
 * @property string $book_images_url
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Genre $genre
 * @property User $author
 * @property BookType $bookType
 * @property BookSettings[] $bookSettings
 * @property Page[] $pages
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'book_type_id', 'genre_id', 'book_title', 'created_at', 'updated_at'], 'required'],
            [['author_id', 'book_type_id', 'genre_id', 'book_status', 'created_at', 'updated_at'], 'integer'],
            [['book_title', 'book_description', 'book_images_url'], 'string', 'max' => 255],
            [['book_title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'author_id' => 'Author ID',
            'book_type_id' => 'Book Type ID',
            'genre_id' => 'Genre ID',
            'book_title' => 'Book Title',
            'book_description' => 'Book Description',
            'book_status' => 'Book Status',
            'book_images_url' => 'Book Images Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['genre_id' => 'genre_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['user_id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookType()
    {
        return $this->hasOne(BookType::className(), ['book_type_id' => 'book_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookSettings()
    {
        return $this->hasMany(BookSettings::className(), ['book_id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['book_id' => 'book_id']);
    }
}
