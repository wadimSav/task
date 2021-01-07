<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Experience extends BaseEnum
{
    const NO_EXP = 0;
    const HAVE_EXP = 1;
    
    /**
     * @var array
     */
    public static $list = [
        self::NO_EXP => 'Нет опыта работы',
        self::HAVE_EXP => 'Есть опыт работы',
    ];
}