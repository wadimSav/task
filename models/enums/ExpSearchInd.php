<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class ExpSearchInd extends BaseEnum
{
    const WITH_EXP = 1;
    const ONE_TO_THREE = 2;
    const THREE_TO_SIX = 3;
    const MORE_SIX = 4;
    
    /**
     * @var array
     */
    public static $list = [
        self::WITH_EXP => 'Без опыта',
        self::ONE_TO_THREE => 'От 1 до 3 лет',
        self::THREE_TO_SIX => 'От 3 до 6 лет',
        self::MORE_SIX => 'Более 6 лет',
    ];
}