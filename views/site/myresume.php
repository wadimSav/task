<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;

$this->title = 'Мои резюме';
?>
<div class="content">
        <div class="container">
            <div class="col-lg-9">
                <div class="main-title mb32 mt50 d-flex justify-content-between align-items-center">
                    <h1 class="main-title mt24 mb16">
                        <?= $this->title ?>
                    </h1>
                    <a href="create/resume" class="link-orange-btn orange-btn my-vacancies-add-btn">Добавить резюме</a>
                    <a class="my-vacancies-mobile-add-btn link-orange-btn orange-btn plus-btn" href="create/resume">+</a>
                </div>
                <div class="tabs mb64">
                    <div class="tabs__content active">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- <div class="d-flex">
                                    <div class="paragraph mb8 mr16">У вас <span>5</span> резюме</div>
                                </div> -->
                                <?= ListView::widget([
                                    'dataProvider' => $resumeList,
                                    'itemView' => function ($model, $key, $index, $widget)
                                    {
                                        return $this->render('_myresumelist', ['model' => $model]);
                                    },
                                    'layout' => "{summary}\n{items}\n{pager}",
                                    'summary' => "У вас {totalCount} резюме",

                                    'itemOptions' => [
                                        'tag' => 'div',
                                        'class' => 'vakancy-page-block my-vacancies-block p-rel mb16'
                                    ],

                                    'emptyText' => 'Вы не опубликовали еще ни одного резуме.',
                                    'emptyTextOptions' => [
                                        'tag' => 'p'
                                    ],

                                    'pager' => [
                                        // 'firstPageLabel' => 'Первая',
                                        'firstPageCssClass' => false,
                                        'lastPageCssClass' => false,
                                        // 'lastPageLabel' => 'Последняя',
                                        'nextPageLabel' => 'Далее <img class="ml8" src="/images/mini-right-arrow.svg" alt="arrow">',
                                        'prevPageLabel' => '<img class="mr8" src="/images/mini-left-arrow.svg" alt="arrow"> Назад',        
                                        'maxButtonCount' => 5,
                                        'prevPageCssClass' => 'page-link-prev',
                                        'nextPageCssClass' => 'page-link-next',
                                        'options' => [
                                            'class' => 'dor-pagination mb128',
                                        ],
                                    ],
                                ]); ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="paragraph mb8 mr16">У вас <span>1</span> резюме</div>
                                </div>
                                <div class="vakancy-page-block my-vacancies-block p-rel mb16">
                                    <div class="row">
                                        <div class="my-resume-dropdown dropdown show mb8">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="images/dots.svg" alt="dots">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                 aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Редактировать</a>
                                                <a class="dropdown-item" href="#">Удалить</a>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 my-vacancies-block__left-col mb32">
                                            <span class="paragraph mr16 mb4">Обновлено сегодня в 12:40</span>
                                            <span class="paragraph my-vacancies-block__time-span">Видно всем</span>
                                            <h2 class="mini-title mb8">PHP разработчик</h2>
                                            <div class="d-flex flex-wrap">
                                                <div class="paragraph mr16">Просмотров
                                                    <span class="grey">26</span>
                                                </div>
                                                <div class="paragraph mr16">Откликов <span class="grey">5</span>
                                                </div>
                                                <a href="#"><span>13</span> подходящих вакансий</a>
                                            </div>
                                        </div>
                                        <div
                                                class="col-xl-12 d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="d-flex flex-wrap mobile-mb12">
                                                <a class="mr16" href="#">Открыть</a>
                                                <a class="mr16" href="#">Изменить видимость</a>
                                            </div>
                                            <span class="mini-paragraph cadet-blue">Опубликовано 23 марта 2020 в
                                                    12:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex">
                                    <div class="paragraph mb8 mr16">У вас <span>1</span> резюме</div>
                                </div>
                                <div class="vakancy-page-block my-vacancies-block p-rel mb16">
                                    <div class="row">
                                        <div class="my-resume-dropdown dropdown show mb8">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="images/dots.svg" alt="dots">
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                 aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Редактировать</a>
                                                <a class="dropdown-item" href="#">Удалить</a>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 my-vacancies-block__left-col mb32">
                                            <span class="paragraph mr16 mb4">Зарплата от 90 000 ₽</span>
                                            <span class="paragraph mr16 mb4">Обновлено сегодня в 12:40</span>
                                            <span class="paragraph my-vacancies-block__time-span">Видно всем</span>
                                            <h2 class="mini-title mb8">PHP разработчик</h2>
                                            <div class="d-flex flex-wrap">
                                                <div class="paragraph mr16">Просмотров
                                                    <span class="grey">26</span>
                                                </div>
                                                <div class="paragraph mr16">Откликов <span class="grey">5</span>
                                                </div>
                                                <a href="#"><span>13</span> подходящих вакансий</a>
                                            </div>
                                        </div>
                                        <div
                                                class="col-xl-12 d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="d-flex flex-wrap mobile-mb12">
                                                <a class="mr16" href="#">Открыть</a>
                                                <a class="mr16" href="#">Изменить видимость</a>
                                            </div>
                                            <span class="mini-paragraph cadet-blue">Опубликовано 23 марта 2020 в
                                                    12:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tabs__content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex flex-wrap pr13">
                                    <div class="paragraph mb8 mr16">У вас <span>5</span> резюме</div>
                                    <div class="vakancy-page-wrap p-rel show mr16">
                                        <a class="vakancy-page-btn arrow-toggle-down-btn dropdown-toggle" href="#"
                                           role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                           aria-haspopup="true" aria-expanded="false">
                                            любое резюме
                                            <i class="fas fa-angle-down arrowDown"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#">За день</a>
                                            <a class="dropdown-item" href="#">За год</a>
                                            <a class="dropdown-item" href="#">За все время</a>
                                        </div>
                                    </div>
                                    <div class="profile-info right-checkbox-block">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1"></label>
                                            <label for="exampleCheck1"
                                                   class="profile-info__check-text job-resolution-checkbox">Отметить
                                                все</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="vakancy-page-block my-vacancies-block p-rel mb16">
                                    <div class="row">
                                        <div class="dropdown profile-info right-checkbox-block">
                                            <div class="form-check d-flex">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                                <label class="form-check-label" for="exampleCheck2"></label>
                                                <label for="exampleCheck2"
                                                       class="profile-info__check-text job-resolution-checkbox"></label>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 my-vacancies-block__left-col mb32">
                                            <span class="paragraph mr16 mb4">Зарплата от 90 000 ₽</span>
                                            <span class="paragraph mr16 mb4">15 июля 2019</span>
                                            <span class="blue-label label">Соискатель</span>
                                            <h2 class="mini-title mb8">PHP разработчик</h2>
                                            <div class="d-flex flex-wrap">
                                                <div class="paragraph mr16">Просмотров
                                                    <span class="grey">26</span>
                                                </div>
                                                <div class="paragraph mr16">Откликов <span class="grey">5</span>
                                                </div>
                                                <a href="#"><span>13</span> подходящих вакансий</a>
                                            </div>
                                        </div>
                                        <div
                                                class="col-xl-12 d-flex justify-content-between align-items-center flex-wrap">
                                            <div class="d-flex flex-wrap mobile-mb12">
                                                <a class="mr16" href="#">Открыть</a>
                                                <a class="mr16" href="#">Удалить</a>
                                            </div>
                                            <span class="mini-paragraph cadet-blue">Заархивировано 23 марта 2020 в 12:00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>