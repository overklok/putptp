<?php
namespace app\modules\book\models;

use common\modules\book\models\Book;
use common\modules\book\models\Genre;
use yii\base\Model;
use Yii;

class CreateForm extends Model
{
    public $genre_id;
    public $book_type_id;

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
            [['genre_id'], 'required'],
            [['book_type_id'], 'required']
        ];
    }

    public function createBook()
    {
        $book = new Book();

        $book->genre_id = $this->genre_id;
        $book->book_type_id = $this->book_type_id;
        $book->book_status = Book::STATUS_WAIT;

        //$arr = [1 => 'Sas', 2 => 'Asa'];

        //echo print_r($arr);
        //exit();

        if ($book->save())
            return $book;

        return false;
    }

}