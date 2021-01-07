<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Monts extends BaseEnum
{
    const JANUARY = 0;
    const FEBRUARY = 1;
    const MARCH = 2;
    const APRIL = 3;
    const MAY = 4;
    const JUNE = 5;
    const JULY = 6;
    const AUGUST = 7;
    const SEPTEMBER = 8;
    const OCTOBER = 9;
    const NOVEMBER = 10;
    const DECEMBER = 11;
    
    /**
     * @var array
     */
    public static $list = [
        self::JANUARY => 'Январь',
        self::FEBRUARY => 'Февраль',
        self::MARCH => 'Март',
        self::APRIL => 'Апрель',
        self::MAY => 'Май',
        self::JUNE => 'Июнь',
        self::JULY => 'Июль',
        self::AUGUST => 'Август',
        self::SEPTEMBER => 'Сентябрь',
        self::OCTOBER => 'Октябрь',
        self::NOVEMBER => 'Ноябрь',
        self::DECEMBER => 'Декабрь',
    ];
}