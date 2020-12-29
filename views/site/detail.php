<?php

/* @var $this yii\web\View */

use app\models\enums\Cities;
use app\models\enums\Employment;
use app\models\enums\Experience;
use app\models\enums\Monts;
use app\models\enums\Shedule;
use app\models\enums\Specialist;
use yii\helpers\Html;

$this->title = 'Резюме ' . Specialist::getLabel($resume->specialization);
?>

<div class="content p-rel">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="mt8 mb32">
                    <a href="/?city=<?= $resume->city ?>">
                        <img src="/images/blue-left-arrow.svg" alt="arrow">
                        <?= 'Резюме в ' . Yii::$app->inflection->inflectGeoName(
                            Cities::getLabel($resume->city),
                            wapmorgan\yii2inflection\Inflector::PREPOSITIONAL
                        ) ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5 mobile-mb32">
                <div class="profile-foto resume-profile-foto">
                    <img src="<?= Yii::getAlias('@web/images/faker-images/') . $resume->image ?>" alt="<?= Specialist::getLabel($resume->specialization) ?>">
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="main-title d-md-flex justify-content-between align-items-center mobile-mb16">
                    <?= Specialist::getLabel($resume->specialization) ?>
                </div>
                <div class="paragraph-lead mb16">
                    <span class="mr24"><?= $resume->desired_salary ?> ₽</span>

                    <?php if ($resume->experience === 1) { ?>
                        <span>Опыт работы
                            <?php $yearExp = $resume->exp[0]->year_end_work - $resume->exp[0]->year;
                            echo $yearExp . $resume->num2word($yearExp, [' год', ' года', ' лет']);
                            ?>
                        </span>
                    <?php } else { ?>
                        <span><?= Experience::getLabel($resume->experience) ?></span>
                    <?php } ?>

                </div>
                <div class="profile-info company-profile-info resume-view__info-blick">
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">Имя
                        </div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <?php
                            $fullNameStr = $resume->my_ucfirst($resume->surname) . ' ' .
                                $resume->my_ucfirst($resume->name) . ' ' .
                                $resume->my_ucfirst($resume->patronymic);
                            echo $fullNameStr;
                            ?>
                        </div>
                    </div>
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">Возраст
                        </div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <?php $age = Yii::$app->formatter->asDate('now', 'php:Y') - Yii::$app->formatter->asDate($resume->birthday, 'php:Y');
                            echo $age . $resume->num2word($age, [' год', ' года', ' лет']);
                            ?>
                        </div>
                    </div>
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">Занятость</div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <?php if ($resume->employment != '') {
                                $employmentList = str_split($resume->employment);
                            } ?>
                            <?php $empArray = []; ?>
                            <?php foreach ($employmentList as $key => $value) {
                                array_push($empArray, Employment::getLabel($value));
                                $employmentStr = implode(', ', $empArray);
                            } ?>
                            <?= $employmentStr ?>
                        </div>
                    </div>
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">График работы
                        </div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <?php if ($resume->schedule != '') {
                                $scheduleList = str_split($resume->schedule);
                            } ?>
                            <?php $scheduleArray = []; ?>
                            <?php foreach ($scheduleList as $key => $value) {
                                array_push($scheduleArray, Shedule::getLabel($value));
                                $scheduleStr = implode(', ', $scheduleArray);
                            } ?>
                            <?= $scheduleStr ?>
                        </div>
                    </div>
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">
                            Город проживания
                        </div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <?= Cities::getLabel($resume->city) ?>
                        </div>
                    </div>
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">
                            Электронная почта
                        </div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <a href="mailto:<?= $resume->email ?>"><?= $resume->email ?></a>
                        </div>
                    </div>
                    <div class="profile-info__block company-profile-info__block mb8">
                        <div class="profile-info__block-left company-profile-info__block-left">
                            Телефон
                        </div>
                        <div class="profile-info__block-right company-profile-info__block-right">
                            <a href="tel:<?= $resume->phone ?>"><?= $resume->phone ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="devide-border mb32 mt50"></div>
                <div class="tabs mb50">
                    <div class="tabs__content active">
                        <div class="row">
                            <div class="col-lg-10">
                                <?php if ($resume->experience === 1) { ?>
                                    <div class="row mb16">
                                        <div class="col-lg-12">
                                            <h3 class="heading mb16">
                                                Опыт работы
                                                <?php
                                                $diffYear = $resume->exp[0]->year_end_work - $resume->exp[0]->year;
                                                echo $diffYear . $resume->num2word($diffYear, [' год', ' года', ' лет']);

                                                $firstKey = array_search($resume->exp[0]->month, Monts::listData());
                                                $lastKey = array_search($resume->exp[0]->month_end_work, Monts::listData());

                                                if ($firstKey !== $lastKey) {
                                                    $diffMonts = $lastKey - $firstKey;
                                                    echo ' и ' . $diffMonts . $resume->num2word($diffMonts, [' месяц', ' месяца', ' месяцев']);
                                                } ?>
                                            </h3>
                                        </div>
                                        <div class="col-md-4 mb16">
                                            <div class="paragraph tbold mb8">
                                                <?= Monts::getLabel($resume->exp[0]->month) . ' ' . $resume->exp[0]->year ?> —
                                                <?php if ($resume->exp[0]->until_now_work !== NULL) {
                                                    echo 'по настоящее время';
                                                } else {
                                                    echo Monts::getLabel($resume->exp[0]->month_end_work) . ' ' . $resume->exp[0]->year_end_work;
                                                } ?>
                                            </div>
                                            <div class="mini-paragraph">
                                                <?php if ($diffMonts > 0) {
                                                    echo $diffYear . $resume->num2word($diffYear, [' год', ' года', ' лет']) . ' ' .
                                                        $diffMonts . $resume->num2word($diffMonts, [' месяц', ' месяца', ' месяцев']);
                                                } elseif ($diffMonts == 0) {
                                                    echo $diffYear . $resume->num2word($diffYear, [' год', ' года', ' лет']);
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="paragraph tbold mb8">
                                                <?= $resume->exp[0]->organization ?>
                                            </div>
                                            <div class="paragraph tbold mb8">
                                                <?= Specialist::getLabel($resume->exp[0]->exp_spec) ?>
                                            </div>
                                            <div class="paragraph">
                                                <?= $resume->exp[0]->responsibility ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <span><?= Experience::getLabel($resume->experience) ?></span>
                                <?php } ?>

                            </div>
                            <?php if ($resume->about !== NULL && $resume->about !== '') { ?>
                                <div class="col-lg-7">
                                    <div class="company-profile-text mb64">
                                        <h3 class="heading mb16">Обо мне</h3>
                                        <p><?= Yii::$app->formatter->asText($resume->about) ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>