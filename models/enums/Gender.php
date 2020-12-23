<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Gender extends BaseEnum
{
    const MALE = 1;
    const FEMALE = 2;
    
    /**
     * @var string message category
     * You can set your own message category for translate the values in the $list property
     * Values in the $list property will be automatically translated in the function `listData()`
     */
    public static $messageCategory = 'app';
    
    /**
     * @var array
     */
    public static $list = [
        self::MALE => 'Мужской',
        self::FEMALE => 'Женский',
    ];
}