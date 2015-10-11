<?php

namespace app\modules\users\controllers;

use Yii;
use yii\base\Controller;

/**
* 
*/
class AdminController extends Controller
{
	
	public function actionIndex()
	{
		$this->render('index');
	}
}

