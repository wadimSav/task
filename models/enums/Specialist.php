<?php

namespace app\models\enums;


use yii2mod\enum\helpers\BaseEnum;


class Specialist extends BaseEnum
{
    const ADMIN_DB = 1;
    const ANALYST = 2;
    const ART_DIRECTOR = 3;
    const ENGINEER = 4;
    const COMP_SECURITY = 5;
    const CONTENT = 6;
    const MARKETING = 7;
    const MULTIMEDIA = 8;
    const SEO = 9;
    const DATA_TRANS_AND_ACCESS_INTERNET = 10;
    const PROG_DEV = 11;
    const SALES = 12;
    const PRODUCER = 13;
    const BUSINESS_DEV = 14;
    const SYS_ADMIN = 15;
    const ERP = 16;
    const CELL_WIRELESS = 17;
    const STARTUP = 18;
    const TELECOM = 19;
    const TESTING = 20;
    const TECH_WRITER = 21;
    const PROJECT_MANAGE = 22;
    const E_COMMERCE = 23;
    const CRM_SYS = 24;
    const WEB_ENGINEER = 25;
    const WEB_MASTER = 26;
    
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
        self::ADMIN_DB => 'Администратор баз данных',
        self::ANALYST => 'Аналитик',
        self::ART_DIRECTOR => 'Арт-директор',
        self::ENGINEER => 'Инженер',
        self::COMP_SECURITY => 'Компьютерная безопасность',
        self::CONTENT => 'Контент',
        self::MARKETING => 'Маркетинг',
        self::MULTIMEDIA => 'Мультимедиа',
        self::SEO => 'Оптимизация сайта (SEO)',
        self::DATA_TRANS_AND_ACCESS_INTERNET => 'Передача данных и доступ в интернет',
        self::PROG_DEV => 'Программирование, Разработка',
        self::SALES => 'Продажи',
        self::PRODUCER => 'Продюсер',
        self::BUSINESS_DEV => 'Развитие бизнеса',
        self::SYS_ADMIN => 'Системный администратор',
        self::ERP => 'Системы управления предприятием (ERP)',
        self::CELL_WIRELESS => 'Сотовые, Беспроводные технологии',
        self::STARTUP => 'Стартапы',
        self::TELECOM => 'Телекоммуникации',
        self::TESTING => 'Тестирование',
        self::TECH_WRITER => 'Технический писатель',
        self::PROJECT_MANAGE => 'Управление проектами',
        self::E_COMMERCE => 'Электронная коммерция',
        self::CRM_SYS => 'CRM системы',
        self::WEB_ENGINEER => 'Web инженер',
        self::WEB_MASTER => 'Web мастер',
    ];
}