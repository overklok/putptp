<?php

namespace common\components\ccy;

use common\modules\globals\models\Currency;
use Yii;

class ccyAgent
{
    const STD_CURRENCY = 'RUR';

    protected $list = array();
    protected $titles = array();
    public $date;

    public function download()
    {
        $xml = new \DOMDocument();

        $xml->formatOutput = true;
        $xml->encoding = "UTF-8";

        $url = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d.m.Y');

        if (@$xml->load($url))
        {
            $this->list = array();
            $this->date = date('d.m.Y');

            $root = $xml->documentElement;
            $items = $root->getElementsByTagName('Valute');

            foreach ($items as $item)
            {
                $code = $item->getElementsByTagName('CharCode')->item(0)->nodeValue;
                $rate = $item->getElementsByTagName('Value')->item(0)->nodeValue;
                $title = iconv('cp1251', 'utf-8', $item->getElementsByTagName('Name')->item(0)->nodeValue);
                $this->list[$code] = floatval(str_replace(',', '.', $rate));
                $this->titles[$code] = $title;

                //var_dump($this->titles); exit();
            }

            return true;
        }

        else
            return false;
    }

    public function get($cur)
    {
        return isset($this->list[$cur]) ? $this->list[$cur] : 0;
    }

    public function getCodes()
    {
        return array_keys($this->list);
    }

    public function getStdCode()
    {
        return self::STD_CURRENCY;
    }

    /**
     * Converting value from one currency to another using rates in the database
     * @var $val float value to convert
     * @var $from string currency string
     * @var $to string currency string
     * @return float
     */
    public static function convert($val, $from, $to)
    {
        if ($from != STD_CURRENCY)
        {
            $from_ccy = Currency::findOne(['currency_name' => $from]);
            $from_rate = $from_ccy->currency_rate;
        }
        else
        {
            $from_rate = 1;
        }

        if($to !=STD_CURRENCY)
        {
            $to_ccy = Currency::findOne(['currency_name' => $to]);
            $to_rate = $to_ccy->currency_rate;
        }
        else
        {
            $to_rate = 1;
        }
        $converted_val = $val * ($from_rate / $to_rate);
        return round($converted_val, 4);
    }

    /*Проблемы с кодировкой*/
    public function getTitle($cur)
    {
        return 'untitled';//isset($this->titles[$cur]) ? $this->titles[$cur] : 'untitled';
    }
}