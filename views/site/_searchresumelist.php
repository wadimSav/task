<?php

use app\models\enums\Cities;
use app\models\enums\Specialist;
use yii\helpers\Url;
use app\models\SearchForm;

$search = new SearchForm();


?>

<div class="row search">
    <div class="my-search-dropdown dropdown show mb8">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="<?= Url::to('@web/images/dots.svg') ?>" alt="Открыть выпадающее меню">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item mod-resume" href="<?= Url::to('@web/myresume/edit/' . $resume->id) ?>">Редактировать</a>
            <a class="dropdown-item delete-resume" href="<?= Url::to('@web/myresume/delete/' . $resume->id) ?>">Удалить</a>
        </div>
    </div>
    <div class="col-xl-12 my-vacancies-block__left-col mb16">
        <h2 class="mini-title mb8">
            <?= Specialist::getLabel($resume->specialization) ?>
        </h2>
        <div class="d-flex align-items-center flex-wrap mb8 ">
            <span class="mr16 paragraph"><?= $resume->desired_salary ?> ₽</span>
            <span class="mr16 paragraph">Опыт работы
                <?= $resume->exp[0]->year_end_work - $resume->exp[0]->year . ' ' . 
                    $resume->num2word($resume->exp[0]->year_end_work - $resume->exp[0]->year, 
                    ['год', 'года', 'лет']) ?> 
            </span>
            <span class="mr16 paragraph"><?= Cities::getLabel($resume->city) ?></span>
        </div>
        <div class="d-flex flex-wrap">
            <div class="paragraph mr16">
                <?php if($resume->viewed !== NULL) { ?>
                    <strong>Просмотров</strong>
                    <span class="grey">
                        <?= $resume->viewed ?>
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-xl-12 d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex flex-wrap mobile-mb12">
            <a class="mr16" href="<?= Url::to('@web/myresume/detail/' . $resume->id)  ?>">Открыть</a>
        </div>
        <span class="mini-paragraph cadet-blue">
            Опубликовано 
            <?= Yii::$app->formatter->asDate($resume->published_at, 'php:d F Y') . ' в
             ' . Yii::$app->formatter->asTime($resume->published_at, 'php:H:m') ?>
        </span>
    </div>
</div>