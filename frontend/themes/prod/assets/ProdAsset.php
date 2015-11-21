<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\themes\prod\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 2.0
 */
class ProdAsset extends AssetBundle
{
    public $basePath = '@webroot/frontend/themes/prod/';
    public $baseUrl = '@web/frontend/themes/prod/assets';
    public $css = [
        /*'css/fonts.css',*/ 'css/third-effects.css', 'css/pptp-style.css'
    ];
    public $js = [
        'js/login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
