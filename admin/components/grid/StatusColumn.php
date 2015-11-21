<?php
namespace app\components\grid;

use Closure;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;


 
class StatusColumn extends \yii\grid\DataColumn
{
    //Статусы
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

    public $format = 'raw';

    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $model->{$this->attribute};
            switch ($value) {
                case self::STATUS_ACTIVE:
                    $class = 'success';
                    break;
                
                case self::STATUS_WAIT:
                    $class = 'warning';
                    break;             

                case self::STATUS_BLOCKED:
                default:
                    $class = 'default';
                    break;
            };
        $html = Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label label-' . $class]);
        return $value === null ? $this->grid->emptyCell : $html;
    }
}
