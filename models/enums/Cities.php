<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Cities extends BaseEnum
{
    const MOSCOW = 1;
    const SAMARA = 2;
    const VOLGOGRAD = 3;
    const EKATERINBURG = 4;
    const TYUMEN = 5;
    const SOCHI = 6;
    const KRASNODAR = 7;
    
    /**
     * @var array
     */
    public static $list = [
        self::MOSCOW => 'Москва',
        self::SAMARA => 'Самара',
        self::VOLGOGRAD => 'Волгоград',
        self::EKATERINBURG => 'Екатеринбург',
        self::TYUMEN => 'Тюмень',
        self::SOCHI => 'Сочи',
        self::KRASNODAR => 'Краснодар',
    ];
}