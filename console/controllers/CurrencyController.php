<?php

namespace console\controllers;

use common\components\ccy\ccyAgent;
use common\modules\globals\models\Currency;
use yii\console\Controller;
use Yii;

class CurrencyController extends Controller
{
 /*
    public function actionTest()
    {
        echo floatval(ccyAgent::convert(10, 'USD', 'EUR'));
    }
*/
    public function actionCodes()
    {
        $cbr = new ccyAgent();

        if($cbr->download())
        {
            $codes = $cbr->getCodes();
            echo 'Basic currency code is ' . $cbr->getStdCode();
            echo <<<END

----------------------------

END;
            foreach ($codes as $code)
            {
                echo <<<END
Currency code available: $code

END;
            }
        }
        else
        {
            Yii::error('Currency rates cannot be downloaded!');
            print 'Currency rates cannot be downloaded!';
            exit();
        }

    }

    public function actionAdd($ccy)
    {
        $cbr = new ccyAgent();
        if($cbr->download())
        {
            Yii::trace('Currency rates downloaded successfully');
            echo <<<END
Currency rates for $cbr->date downloaded. Trying to add new currency $ccy...

END;
        }
        else
        {
            Yii::error('Currency rates cannot be downloaded!');
            print 'Currency rates cannot be downloaded!';
            exit();
        }

        if($cbr->get($ccy))
        {
            echo <<<END
All rates including $ccy for $cbr->date downloaded. Updating the database...

END;
        }
        else
        {
            echo <<<END
Rate $ccy is not exists in CBRF database.

END;
            return false;
        }

        $model = new Currency();
        $model->currency_name = $ccy;
        $model->currency_rate = $cbr->get($ccy);
        $model->currency_title = $cbr->getTitle($ccy);

        if ($model->save() && $this->actionUpdate())
        {
            echo <<<END
Database is updated.

END;
            return true;
        }

        else
        {
            echo <<<END
Database cannot be updated.

END;
            Yii::error('Error while updating the database with new ' . $ccy . 'currency');
            return false;
        }
    }

    public function actionUpdate()
    {
        $cbr = new ccyAgent();
        if($cbr->download())
        {
            Yii::trace('Currency rates downloaded successfully');
            echo <<<END
Currency rates for $cbr->date downloaded. Updating the database...

END;
        }
        else
        {
            Yii::error('Currency rates cannot be downloaded!');
            print 'Currency rates cannot be downloaded!';
            exit();
        }

        $ccys = Currency::find()->all();

        if(!$ccys)
            echo <<<END
Nothing to update.

END;

        foreach ($ccys as $ccy)
        {
            $new_ccy = Currency::findOne(['currency_name' => $ccy->currency_name]);
            $rate = $cbr->get($ccy->currency_name);
            $title = $cbr->getTitle($ccy);

            $new_ccy->currency_rate = $rate;
            $new_ccy->currency_title = $title;
            if(!$new_ccy->save())
            {
                echo 'Currency ' . $new_ccy->currency_name . ' cannot be updated!';
                Yii::error('Currency ' . $new_ccy->currency_name . ' cannot be updated');
                return false;
            }

            echo <<<END
Currency $new_ccy->currency_name is successfully updated!

END;
        }

        return true;
    }
}
