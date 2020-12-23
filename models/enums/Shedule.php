<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Shedule extends BaseEnum
{
    const FULL_DAY = 1;
    const SHIFT = 2;
    const FLEXIBLE = 3;
    const REMOTE = 4;
    const ROTATIONAL = 5;
    
    /**
     * @var string message category
     * You can set your own message category for translate the values in the $list property
     * Values in the $list property will be automatically translated in the function `listData()`
     */
    // public static $messageCategory = 'app';
    
    /**
     * @var array
     */
    public static $list = [
        self::FULL_DAY => 'Полный день',
        self::SHIFT => 'Сменный график',
        self::FLEXIBLE => 'Гибкий график',
        self::REMOTE => 'Удалённая работа',
        self::ROTATIONAL => 'Вахтовый метод',
    ];
}