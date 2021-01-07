<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/main.css',
        'css/jquery.nselect.css',
        'css/bootstrap-datepicker.css',
        // 'css/select2.min.css'
    ];
    public $js = [
        'js/main.js',
        'js/jquery.nselect.min.js',
        'js/bootstrap-datepicker.js',
        'js/bootstrap-datepicker.ru.min.js',
        'js/jquery-editable-select.js',
        // 'js/select2.full.min.js',
        // 'js/ru.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
