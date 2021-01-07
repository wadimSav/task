<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Employment extends BaseEnum
{
    const FULL = 1;
    const PART_TIME = 2;
    const PROJECT_TEMPORARY = 3;
    const VOLUNTEERING = 4;
    const INTERNSHIP = 5;
    
    /**
     * @var array
     */
    public static $list = [
        self::FULL => 'Полная занятость',
        self::PART_TIME => 'Частичная занятость',
        self::PROJECT_TEMPORARY => 'Проектная/Временная работа',
        self::VOLUNTEERING => 'Волонтёрство',
        self::INTERNSHIP => 'Стажировка',
    ];
}