<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
//        'material/css/roboto.min.css',
//        'material/css/material.min.css',
//        'material/css/ripples.min.css',
    ];
    public $js = [
//        'js/jquery-1.11.3.min.js',
        'js/bootstrap.js',
        'js/bootstrap-datepicker.min.js',
//        'material/js/material.min.js',
//        'material/js/ripples.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
