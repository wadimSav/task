<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\helpers\VarDumper;

$this->title = 'Список резюме';

?>

<?php 
$script = <<< JS
$(document).ready(function() {
    // setting a default timeout for pjax
    $.pjax.defaults.timeout = 1200;

    $('#spec-search').nSelect({
        firstTitle: 'Выберите профессию',
        afterChange: function(el) {
            $(this)[0].firstTitle = el[0].innerText;

        }
    });

    $('#city-search').nSelect({
        firstTitle: 'Выберите город',
        afterChange: function(el) {
            $(this)[0].firstTitle = el[0].innerText;

        }
    })

    $('#salary').change(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        url.searchParams.set('desired_salary', evt.target.value); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })
    $('.field-spec-search>.nselect>.nselect__inner>ul>li>span').click(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        url.searchParams.set('specialization', evt.target.parentElement.dataset.val); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })

    $('.field-city-search>.nselect>.nselect__inner>ul>li>span').click(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        url.searchParams.set('city', evt.target.parentElement.dataset.val); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })
    $('#agefrom').change(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        url.searchParams.set('agefrom', evt.target.value); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })
    $('#ageto').change(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        url.searchParams.set('ageto', evt.target.value); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })
    $('input[type="radio"]').click(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        url.searchParams.set('experience', $('input[type="radio"]:checked').val()); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })
});

JS;
$this->registerJs($script);
 ?>
<div class="header-search">
    <div class="container">
        <div class="header-search__wrap">
            <form class="header-search__form">
                <a href="#"><img src="/images/dark-search.svg" alt="search" class="dark-search-icon header-search__icon"></a>
                <input class="header-search__input" type="text" placeholder="Поиск по резюме и навыкам">
                <button type="button" class="blue-btn header-search__btn">Найти</button>
            </form>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <h1 class="main-title mt24 mb16">PHP разработчики в Кемерово</h1>
        <button class="vacancy-filter-btn">Фильтр</button>
        <div class="row">
            <div class="col-lg-9 desctop-992-pr-16">
                <div class="d-flex align-items-center flex-wrap mb8">
                    <span class="paragraph mr16">Найдено <?= $listResume->totalCount ?> резюме</span>
                    <div class="vakancy-page-header-dropdowns">
                        <div class="vakancy-page-wrap show mr16">
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">За день</a>
                                <a class="dropdown-item" href="#">За год</a>
                                <a class="dropdown-item" href="#">За все время</a>
                            </div>
                        </div>
                        <div class="vakancy-page-wrap show">
                            <button class="vakancy-page-btn vakancy-btn dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="filter">Сортировать</span>
                                <i class="fas fa-angle-down arrowDown"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                           <!-- sort links -->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <?php Pjax::begin([
                    'timeout' => 100000, 
                    'enablePushState' => true, 
                    'formSelector' => '#searcher',
                    'linkSelector' => '.run-pjax',
                ]); ?>

                <?= ListView::widget([
                    'dataProvider' => $listResume,

                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('_allresume', ['model' => $model]);
                    },
                    'layout' => "{items}\n{pager}",
                    'summary' => "Найдено {totalCount} резюме",

                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'vakancy-page-block company-list-search__block resume-list__block p-rel mb16'
                    ],

                    'emptyText' => 'Вы не опубликовали еще ни одного резуме.',
                    'emptyTextOptions' => [
                        'tag' => 'p'
                    ],

                ]); ?>
                <?php Pjax::end(); ?>

                <ul class="dor-pagination mb128">
                    <li class="page-link-prev"><a href="#"><img class="mr8" src="/images/mini-left-arrow.svg" alt="arrow"> Назад</a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a class="grey" href="#">...</a></li>
                    <li class="active"><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a class="grey" href="#">...</a></li>
                    <li><a href="#">10</a></li>
                    <li class="page-link-next"><a href="#">Далее <img class="ml8" src="/images/mini-right-arrow.svg" alt="arrow"></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                <div class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                    <div class="heading">Фильтр</div>
                    <img class="cursor-p" src="/images/big-cancel.svg" alt="cancel">
                </div>
                <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                    <!-- <a href="#" class="signin-modal__switch-btn ">Мужчины</a> -->
                    
                    <?= Html::a("Все", 
                        Url::to(['site/index']), 
                        ['class' => 'signin-modal__switch-btn active run-pjax', 'data-pjax' => 1]
                    ) ?>
                    <?= Html::a("Мужчины", Url::to(['/', 'gender' => 1]), ['class' => 'signin-modal__switch-btn data run-pjax', 'data-pjax' => 1]) ?>
                    <?= Html::a("Женщины", Url::to(['/', 'gender' => 2]), ['class' => 'signin-modal__switch-btn data run-pjax', 'data-pjax' => 1]) ?>
                    <!-- <a href="#" class="signin-modal__switch-btn ">Женщины</a> -->
                </div>
                
                <?= $this->render('_search', ['model' => $searchModel]) ?>
                <!-- filters -->
                
                
                
                
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">График работы</div>
                    <div class="profile-info">
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck10">
                            <label class="form-check-label" for="exampleCheck10"></label>
                            <label for="exampleCheck10" class="profile-info__check-text">Полный день</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck11">
                            <label class="form-check-label" for="exampleCheck11"></label>
                            <label for="exampleCheck11" class="profile-info__check-text">Сменный график</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck12">
                            <label class="form-check-label" for="exampleCheck12"></label>
                            <label for="exampleCheck12" class="profile-info__check-text">Вахтовый метод</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck13">
                            <label class="form-check-label" for="exampleCheck13"></label>
                            <label for="exampleCheck13" class="profile-info__check-text">Гибкий график</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck14">
                            <label class="form-check-label" for="exampleCheck14"></label>
                            <label for="exampleCheck14" class="profile-info__check-text">Удалённая
                                работа</label>
                        </div>
                    </div>
                </div>
                <div class="vakancy-page-filter-block__row vakancy-page-filter-block__show-vakancy-btns mb24 d-flex flex-wrap align-items-center mobile-jus-cont-center">
                    <a class="link-orange-btn orange-btn mr24 mobile-mb12" href="#">Показать <span>1 230</span>
                        вакансии</a>
                    <a href="#">Сбросить все</a>
                </div>
                
                <!-- filters -->
            </div>
        </div>
    </div>
</div>
