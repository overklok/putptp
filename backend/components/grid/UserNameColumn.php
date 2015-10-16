<?php
namespace app\components\grid;

use app\modules\books\models\Book;
use Closure;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
 
class UserNameColumn extends \yii\grid\DataColumn
{
    //callable
    public $url;
    //bool
    public $targetBlank = false;
    //string
    public $controller;
    public $user_name;
    //string
    public $format = 'raw';

    protected function renderDataCellContent($model, $key, $index)
    {
        $model_info = new Book();
        $model = 'app\modules\books\models\BookSearch';
        $key = 'user_name';


        $value = $this->getDataCellValue($model, $key, $index);
    //    $text = $this->grid->formatter->format($value, $this->format);
    //    $url = $this->createUrl($model, $key, $index);
    //    $options = $this->targetBlank ? ['target' => '_blank'] : [];
        //$value = $model_info->getAuthorNameById($model_info->author_id);
        return $value === null ? $this->grid->emptyCell : $value;//Html::a($text, $url, $options);
    }

    protected function createUrl($model, $key, $index)
    {
        if ($this->url instanceof Closure)
        {
            return call_user_func($this->url, $model, $key, $index);
        }
        else
        {
            $params = is_array($key) ? $key : ['user_name' => (string) $key];
            $params[0] = $this->controller ? $this->controller . '/view' : 'view';
            Url::toRoute($params);
        }
    }
}
