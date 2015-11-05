<?php

namespace common\modules\book\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "book_chapter".
 *
 * @property integer $chapter_id
 * @property integer $book_id
 * @property string $chapter_content
 * @property string $chapter_title
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Book $book
 */
class BookChapter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chapter_id', 'book_id', 'chapter_title'], 'required'],
            [['chapter_id', 'book_id', 'created_at', 'updated_at'], 'integer'],
            [['chapter_title', 'chapter_content'], 'string']
        ];
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
    public function attributeLabels()
    {
        return [
            'chapter_id' => 'Chapter ID',
            'book_id' => 'Book ID',
            'content' => 'Content',
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

    public function firstChapter()
    {
        return BookChapter::find()->where(['book_id' => $this->book_id])->min('chapter_id');
    }

    public function addChapter()
    {
        $chaps = BookChapter::find()->where(['book_id' => $this->book_id]);

        if ($this->chapter_id = $chaps->max('chapter_id'))
            { $this->chapter_id++; }
        else
            { $this->chapter_id = 1; }

        $this->chapter_title = $this->chapter_title ? $this->chapter_title : 'Chapter #' . $this->chapter_id;

        return $this->chapter_id;
    }


}
