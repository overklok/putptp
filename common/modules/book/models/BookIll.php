<?php

namespace common\modules\book\models;

use common\modules\book\models\BookSettings;
use Yii;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "book_ill".
 *
 * @property integer $book_ill_id
 * @property string $book_ill_url
 * @property integer $book_id
 *
 * @property Book $book
 */
class BookIll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_ill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_ill_url', 'book_id'], 'required'],
            [['book_id'], 'integer'],
            //[['book_ill_url'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 2],
            [['book_ill_url'], 'string', 'max' => 14],
            [['book_ill_url'], 'unique'],
            ['book_ill_url', 'validateExtension']
        ];
    }

    public function validateExtension($attribute, $params)
    {
        $ext = explode('.', basename($this->$attribute));
        $ext = array_pop($ext);

        //var_dump($ext); exit();

        if($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png')
        //var_dump($ext); exit();
            $this->addError($attribute, 'You can upload ".jpg" and ".png" files only.');

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'book_ill_id' => 'Book Illustration ID',
            'book_ill_url' => 'Book Illustration',
            'book_id' => 'Book ID',
        ];
    }

    public function upload($id, $tmp_name, $filename, $folder, $cover)
    {
        $settings = BookSettings::findOne(['book_id' => $id]);
        $new_cover = ($settings->book_cover == null);
        $ext = explode('.', basename($filename));

        $this->book_id = $id;

        if ($new_cover || !$cover) //если ОБЛОЖКИ НЕТ или заливаем НЕ ОБЛОЖКУ
            $this->book_ill_url = $this->getRandomFileName() . '.' . array_pop($ext);   //придётся генерировать новый ключ
        else                                           //если ОБЛОЖКА ЕСТЬ и заливаем ОБЛОЖКУ
        {
            $old_ill = BookIll::findOne($settings->book_cover);
            $this->book_ill_url = $old_ill->book_ill_url;                                //переписываем по старому ключу
            $this->book_ill_id = $old_ill->book_ill_id;
        }

        $target = $folder . DIRECTORY_SEPARATOR . $this->book_ill_url;

        if($cover && !$new_cover && move_uploaded_file($tmp_name, $target))
        {
            return $target;
        }

        if($this->validate() && $this->save() && move_uploaded_file($tmp_name, $target))
        {
            if ($cover)
            {
                $settings->book_cover = $this->book_ill_id;
                if($settings->save())
                    return $target;
                //else что-то сделать, мб ошибку сохранения. Но просто так не оставлять
            }

            return $target;
        }
        else {
            return false;
        }
    }

    public function getOneIll($id)
    {
        return BookIll::findOne($id)->book_ill_url;
    }

    public static function getIllsByBook($book_id, $cover = false)
    {
        $settings = BookSettings::findOne(['book_id' => $book_id]);
        $ids = [];

        $folder = DIRECTORY_SEPARATOR . Yii::$app->params['uploadRoot'] . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $settings->book_images_cat . DIRECTORY_SEPARATOR;

        if ($cover)
        {
            $book_ill = BookIll::findOne(['book_ill_id' => $settings->book_cover]);

            //var_dump($book_ill->book_ill_url); exit();

            if($book_ill->book_ill_url)
                $ids = [Html::img($folder . $book_ill->book_ill_url, ['class' => 'preview-image', 'style' => 'width: 200px'])];
        }
        else {
            $book_ills = BookIll::findAll(['book_id' => $book_id]);
            foreach ($book_ills as $i => $book_ill)
            {
                if($book_ill->book_ill_url)
                    $ids[$i] = Html::img($folder . $book_ill->book_ill_url, ['class' => 'preview-image', 'style' => 'width: 200px']);
            }
        }

        return $ids;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['book_id' => 'book_id']);
    }

    public function getRandomFileName()
    {
        do {
            $name = substr(md5(microtime() . rand(0, 9999)), 0, 10);
        } while (BookIll::findOne(['book_ill_url' => $name]));

        return $name;
    }
}
