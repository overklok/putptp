<?php
namespace app\modules\book\models;

use common\modules\book\models\Book;
use common\modules\book\models\BookSettings;
use yii\base\Model;
use Yii;

class CreateForm extends Model
{
    public $genre_id;
    public $book_type_id;
    public $book_images_cat;

    public function attributeLabels()
    {
        return [
            'genre_id' => 'Genres',
            'book_type_id' => 'Book Types',
        ];
    }



    public function rules()
    {
        return [
            [['genre_id', 'book_type_id', 'book_images_cat'], 'required'],
            [['book_images_cat'], 'string', 'max' => 10],
        ];
    }

    public function createBook()
    {
        $book = new Book();

        $book->genre_id = $this->genre_id;
        $book->book_type_id = $this->book_type_id;
        $book->book_status = Book::STATUS_WAIT;

        if ($book->save()) {

            $this->book_images_cat = self::getRandomCatName();

            $uploaddir = Yii::$app->params['uploadRoot'] . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $this->book_images_cat;
            if(!file_exists($uploaddir))
                mkdir($uploaddir, 0777);

            $settings = new BookSettings();
            $settings->book_id = $book->book_id;
            $settings->book_images_cat = $this->book_images_cat;

            if($settings->save())
                return $book;
        }
        return false;
    }

    public static function getRandomCatName()
    {
        do {
            $name = substr(md5(microtime() . rand(0, 9999)), 0, 10);
        } while (BookSettings::findOne(['book_images_cat' => $name]));

        return $name;
    }

}