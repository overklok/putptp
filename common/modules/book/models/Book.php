<?php

namespace common\modules\book\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use app\modules\users\models\User;

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
 * @property User $author
 * @property BookType $bookType
 * @property Genre $genre
 * @property BookSettings[] $bookSettings
 * @property Page[] $pages
 */
class Book extends \yii\db\ActiveRecord
{
    //Статусы пользователя
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

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
          //  ['author_id', 'required'],
            ['author_id', 'integer'],

            ['genre_id', 'required'],
            ['genre_id', 'integer'],
            ['genre_id', 'in', 'range' => array_keys(self::getGenresArray())],

            ['book_type_id', 'required'],
            ['book_type_id', 'integer'],
            ['book_type_id', 'in', 'range' => array_keys(self::getBookTypesArray())],

            [['book_title', 'book_description', 'book_images_url'], 'string', 'max' => 255],
            ['book_title', 'unique', 'targetClass' => self::className(), 'message' => 'This title has already been taken.'],
            ['book_title', 'string', 'min' => 2, 'max' => 255],

            ['book_status', 'integer'],
            ['book_status', 'default', 'value' => self::STATUS_ACTIVE],
            ['book_status', 'in', 'range' => array_keys(self::getStatusesArray())],
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
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->author_id = Yii::$app->user->id;
            return true;
        }
        return false;
    }



    //STATUS LIST ITEMS

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->book_status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Locked',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_WAIT => 'Waiting for a confirm',
        ];
    }

    //BOOK TYPE LIST ITEMS

    public function getBookTypeTitle()
    {
        return ArrayHelper::getValue(self::getBookTypesArray(), $this->book_type_id);
    }

    public static function getBookTypesArray()
    {
        $types = BookType::find()->select('book_type_id', 'book_type_title')->asArray()->all();

        $arr = array();

        foreach ($types as $i => $type)
        {
            $arr[$i+1] = $type['book_type_id'];
        }

        return $arr;
    }

    //GENRE LIST ITEMS

    public function getGenreTitle()
    {
        return ArrayHelper::getValue(self::getGenresArray(), $this->genre_id);
    }

    public static function getGenresArray()
    {
        $types = Genre::find()->select('genre_id', 'genre_title')->asArray()->all();

        $arr = array();

        foreach ($types as $i => $type)
        {
            $arr[$i+1] = $type['genre_id'];
        }

        return $arr;
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
    public function getGenre()
    {
        return $this->hasOne(Genre::className(), ['genre_id' => 'genre_id']);
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
