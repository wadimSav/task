<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Резюме ' . $resume->specialization;
?>

<div class="content p-rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb32"><a href="/"><img src="/images/blue-left-arrow.svg" alt="arrow"> Резюме в
                        Кемерово</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-5 mobile-mb32">
                    <div class="profile-foto resume-profile-foto"><img src="<?= $resume->image ?>" alt="<?= $resume->specialization ?>">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="main-title d-md-flex justify-content-between align-items-center mobile-mb16">
                        <?= $resume->specialization ?>
                    </div>
                    <div class="paragraph-lead mb16">
                        <span class="mr24"><?= $resume->desired_salary ?> ₽</span>

                        <?php if($resume->experience === 'Есть опыт работы') { ?>
                        <span>Опыт работы <?= $resume->exp[0]->year_end_work - $resume->exp[0]->year ?> года</span>
                        <?php } else { ?>
                            <span><?= $resume->experience ?></span>
                        <?php } ?>

                    </div>
                    <div class="profile-info company-profile-info resume-view__info-blick">
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Имя
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?php
                                    $fullNameStr = $resume->my_ucfirst($resume->surname) . ' ' . $resume->my_ucfirst($resume->name) . ' ' . $resume->my_ucfirst($resume->patronymic);
                                    echo $fullNameStr;
                                 ?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Возраст
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?= Yii::$app->formatter->asDate('now', 'php:Y') - Yii::$app->formatter->asDate($resume->birthday, 'php:Y') ?>
                                 года
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Занятость</div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?= $resume->employment ?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">График работы
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?= $resume->schedule ?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Город проживания
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                            <?= $resume->city ?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Электронная почта
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <a href="#"><?= $resume->email ?></a>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Телефон
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <a href="#"><?= $resume->phone ?></a>
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
                                <?php if($resume->experience === 'Есть опыт работы') { ?>
                                    <div class="row mb16">
                                        <div class="col-lg-12">
                                            <h3 class="heading mb16">
                                                Опыт работы 
                                                <?php 
                                                    $diffYear = $resume->exp[0]->year_end_work - $resume->exp[0]->year;
                                                    
                                                    echo $diffYear . $resume->num2word($diffYear, [' год', ' года', ' лет']);
                                                ?>

                                                <?php 
                                                    $monts = [12 => 'Декабрь', 1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель', 
                                                              5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь',];
                                                    $firstKey = array_search($resume->exp[0]->month, $monts);
                                                    $lastKey = array_search($resume->exp[0]->month_end_work, $monts);

                                                    if($firstKey !== $lastKey) {
                                                        $diffMonts = $lastKey - $firstKey;
                                                        echo ' и ' . $diffMonts . $resume->num2word($diffMonts, [' месяц', ' месяца', ' месяцев']);
                                                    }
                                                ?>
                                            </h3>
                                        </div>
                                        <div class="col-md-4 mb16">
                                            <div class="paragraph tbold mb8">
                                                <?= $resume->exp[0]->month . ' ' . $resume->exp[0]->year ?> — 
                                                <?php if($resume->exp[0]->until_now_work !== NULL) {
                                                    echo 'по настоящее время';
                                                } else {
                                                    echo $resume->exp[0]->month_end_work . ' ' . $resume->exp[0]->year_end_work;
                                                } ?>
                                            </div>
                                            <div class="mini-paragraph">
                                                <?= $diffYear . $resume->num2word($diffYear, [' год', ' года', ' лет']) . ' ' . $diffMonts . $resume->num2word($diffMonts, [' месяц', ' месяца', ' месяцев']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="paragraph tbold mb8">
                                                <?= $resume->exp[0]->organization ?>
                                            </div>
                                            <div class="paragraph tbold mb8">
                                                <?= $resume->exp[0]->exp_spec ?>
                                            </div>
                                            <div class="paragraph">
                                                <?= $resume->exp[0]->responsibility ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php } else { ?>
                                    <span><?= $resume->experience ?></span>
                                <?php } ?>
                                    
                                </div>
                                <?php if($resume->about !== NULL && $resume->about !== '') { ?>
                                <div class="col-lg-7">
                                    <div class="company-profile-text mb64">
                                        <h3 class="heading mb16">Обо мне</h3>
                                        <p><?= Html::encode($resume->about) ?></p>
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