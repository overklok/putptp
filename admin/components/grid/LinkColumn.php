<?php
namespace app\components\grid;

use Closure;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
 
class LinkColumn extends \yii\grid\DataColumn
{
    //callable
    public $url;
    //bool
    public $targetBlank = false;
    //string
    public $module;
    public $controller;
    public $format = 'raw';

    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        $text = $this->grid->formatter->format($value, $this->format);
        $url = $this->createUrl($model, $key, $index);
        $options = $this->targetBlank ? ['target' => '_blank'] : [];
        return $value === null ? $this->grid->emptyCell : Html::a($text, $url, $options);
    }

    protected function createUrl($model, $key, $index)
    {
        if ($this->url instanceof Closure)
        {
            return call_user_func($this->url, $model, $key, $index);
        }
        else
        {
            $this->controller = Yii::$app->controller->id;
            //$params = is_array($key) ? $key : ['id' => (string) $key];
            $params[0] = '/' . $this->module . '/' . $this->controller . '/' . $key;

            return Url::to($params);
        }
    }
}
