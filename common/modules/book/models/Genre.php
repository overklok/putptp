<?php

namespace common\modules\book\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property integer $genre_id
 * @property string $genre_name
 * @property string $genre_title
 *
 * @property Book[] $book
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['genre_name'], 'required'],
            [['genre_name'], 'string', 'max' => 255],
            [['genre_title'], 'string', 'max' => 50],
            [['genre_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'genre_id' => 'Genre ID',
            'genre_name' => 'Genre Name',
            'genre_title' => 'Genre Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['genre_id' => 'genre_id']);
    }
}
