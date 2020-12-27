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
    $('#resumesearch-employment>.form-check>input:checkbox').click(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        let empParam = '';
        $('#resumesearch-employment>.form-check>input:checkbox:checked').each(function(){
            empParam += $(this).val();
        })
        url.searchParams.set('employment', empParam); 
        history.pushState(null, null, url);    // == url.href
        $.pjax({
            url: url,
            container: '#p0'
        });
    })
    $('#resumesearch-schedule>.form-check>input:checkbox').click(function(evt) {
        const url = new URL(window.location);  // == window.location.href
        let empParam = '';
        $('#resumesearch-schedule>.form-check>input:checkbox:checked').each(function(){
            empParam += $(this).val();
        })
        url.searchParams.set('schedule', empParam); 
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
        <h1 class="main-title mt24 mb16"><?= $this->title; ?></h1>
        <button class="vacancy-filter-btn">Фильтр</button>
        <div class="row">
            <div class="col-lg-9 desctop-992-pr-16">
                <?php Pjax::begin([
                    'enablePushState' => true, 
                    'formSelector' => '#searcher',
                    'linkSelector' => '.run-pjax',
                ]); ?>
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
                <?php Pjax::end(); ?>

            </div>
            <div class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                <div class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                    <div class="heading">Фильтр</div>
                    <img class="cursor-p" src="/images/big-cancel.svg" alt="cancel">
                </div>
                <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                    <?= Html::a("Все", 
                        Url::to(['site/index']), 
                        ['class' => 'signin-modal__switch-btn active run-pjax', 'data-pjax' => 1]
                    ) ?>
                    <?= Html::a("Мужчины", Url::to(['/', 'gender' => 1]), ['class' => 'signin-modal__switch-btn data run-pjax', 'data-pjax' => 1]) ?>
                    <?= Html::a("Женщины", Url::to(['/', 'gender' => 2]), ['class' => 'signin-modal__switch-btn data run-pjax', 'data-pjax' => 1]) ?>
                </div>
                <!-- Форма фильтрации -->
                <?= $this->render('_search', ['model' => $searchModel]) ?>
                <!-- Форма фильтрации -->
                <div class="vakancy-page-filter-block__row vakancy-page-filter-block__show-vakancy-btns mb24 d-flex flex-wrap align-items-center mobile-jus-cont-center">
                    <a class="link-orange-btn orange-btn mr24 mobile-mb12" href="#">Показать <span>1 230</span>
                        вакансии</a>
                    <a href="#">Сбросить все</a>
                </div>
            </div>
        </div>
    </div>
</div>
