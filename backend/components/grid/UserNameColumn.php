<?php
namespace app\components\grid;

use app\modules\books\models\BookSearch;
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
        $model = 'app\modules\books\models\BookSearch';
        $key = 'user_name';


        $value = $this->getDataCellValue($model, $key, $index);
        $text = $this->grid->formatter->format($value, $this->format);
        //$url = $this->createUrl($model, $key, $index);
        //$options = $this->targetBlank ? ['target' => '_blank'] : [];
        //return $value === null ? $this->grid->emptyCell : Html::a($text, $url, $options);
        return $value;
    }

    protected function createUrl($model, $key, $index)
    {
        if ($this->url instanceof Closure)
        {
            return call_user_func($this->url, $model, $key, $index);
        }
        else
        {
            $params = is_array($key) ? $key : ['id' => (string) $key];
            $params[0] = $this->controller ? $this->controller . '/view' : 'view';
            return Url::toRoute($params);
        }
    }
}
