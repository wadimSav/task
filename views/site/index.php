<?php

/* @var $this yii\web\View */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = 'Список резюме';
$script = <<< JS
$(document).ready(function() {
    $('#salary').change(function(evt) {
        // console.log(evt.target);  + evt.target.value
        $.pjax({
            url: 'site/salary/' + evt.target.value,
            success: function(res){
                console.log($('#p0'));
                $('#p0').replaceWith(res);
                // window.location = location.href
            },
            error: function(){
                console.log('Error!');
            },
            // container: '#p0',
        },).reload({container: '#p0'});
    });
});
JS;
$this->registerJs($script);
?>

<?php Pjax::begin(); ?>
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
                                <span class="filter">Фильтровать</span>
                                <i class="fas fa-angle-down arrowDown"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <?= $listResume->sort->link(
                                    'updated_at',
                                    [
                                        'label' => 'По новизне',
                                        'class' => 'dropdown-item',
                                        'default' => SORT_ASC,
                                    ]
                                ) ?>
                                <?= $listResume->sort->link(
                                    'desired_salary',
                                    [
                                        'label' => 'По зарплате',
                                        'class' => 'dropdown-item',
                                        //  'default' => SORT_DESC,
                                    ]
                                ) ?>
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

                    // 'options' => [
                    //     'tag' => 'div',
                    //     'class' => 'vakancy-page-block company-list-search__block resume-list__block p-rel mb16'
                    // ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'vakancy-page-block company-list-search__block resume-list__block p-rel mb16'
                    ],

                    'emptyText' => 'Вы не опубликовали еще ни одного резуме.',
                    'emptyTextOptions' => [
                        'tag' => 'p'
                    ],

                ]); ?>


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
                    <?= Html::a("Все", ['site/index'], ['class' => 'signin-modal__switch-btn active']) ?>
                    <?= Html::a("Мужчины", ['site/man'], ['class' => 'signin-modal__switch-btn']) ?>
                    <?= Html::a("Женщины", ['site/woman'], ['class' => 'signin-modal__switch-btn']) ?>
                    <!-- <a href="#" class="signin-modal__switch-btn ">Женщины</a> -->
                </div>
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">Город</div>
                    <div class="citizenship-select">
                        <?php if ($cities !== NULL) { ?>

                            <!-- <select class="nselect-1"> -->
                            <div class="dropdown w-100 nselect ns-sys nsOrange dropdownCity">
                                <button class="dropdown-toggle w-100 nselect__head" type="button" id="dropdownCityButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Выберите город
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownCityButton">
                                    <?php foreach ($cities as $city) { ?>
                                        <?= Html::a($city->city, ['site/city/' . $city->city], ['class' => 'dropdown-item']) ?>
                                    <?php } ?>
                                    <!-- <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a> -->
                                </div>
                            </div>


                            <!-- </select> -->
                        <?php } ?>
                    </div>
                </div>
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">Зарплата</div>
                    <div class="p-rel">
                        <!-- <input placeholder="Любая" type="text" class="dor-input w100" id="salary"> -->
                        <?= Html::input('text', 'desired_salary', ['id' => 'salary', 'class' => 'dor-input w100', 'placeholder']) ?>
                        <img class="rub-icon" src="/images/rub-icon.svg" alt="rub-icon">
                    </div>
                </div>
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">Специализация</div>
                    <div class="citizenship-select">
                        <select class="nselect-1" data-title="Любая">
                            <option value="01">Фронтенд</option>
                            <option value="02">Бекенд</option>
                            <option value="03">Дизайн</option>
                            <option value="04">Тестировщик</option>
                        </select>
                    </div>
                </div>
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">Возраст</div>
                    <div class="d-flex">
                        <input placeholder="От" type="text" class="dor-input w100">
                        <input placeholder="До" type="text" class="dor-input w100">
                    </div>
                </div>
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">Опыт работы</div>
                    <div class="profile-info">
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1"></label>
                            <label for="exampleCheck1" class="profile-info__check-text">Без опыта</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2"></label>
                            <label for="exampleCheck2" class="profile-info__check-text">От 1 года до 3
                                лет</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck3">
                            <label class="form-check-label" for="exampleCheck3"></label>
                            <label for="exampleCheck3" class="profile-info__check-text">От 3 лет до 6
                                лет</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck4">
                            <label class="form-check-label" for="exampleCheck4"></label>
                            <label for="exampleCheck4" class="profile-info__check-text">Более 6 лет</label>
                        </div>
                    </div>
                </div>
                <div class="vakancy-page-filter-block__row mb24">
                    <div class="paragraph cadet-blue">Тип занятости</div>
                    <div class="profile-info">
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck5">
                            <label class="form-check-label" for="exampleCheck5"></label>
                            <label for="exampleCheck5" class="profile-info__check-text">Полная занятость</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck6">
                            <label class="form-check-label" for="exampleCheck6"></label>
                            <label for="exampleCheck6" class="profile-info__check-text">Частичная
                                занятость</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck7">
                            <label class="form-check-label" for="exampleCheck7"></label>
                            <label for="exampleCheck7" class="profile-info__check-text">Проектная работа</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck8">
                            <label class="form-check-label" for="exampleCheck8"></label>
                            <label for="exampleCheck8" class="profile-info__check-text">Стажировка</label>
                        </div>
                        <div class="form-check d-flex">
                            <input type="checkbox" class="form-check-input" id="exampleCheck9">
                            <label class="form-check-label" for="exampleCheck9"></label>
                            <label for="exampleCheck9" class="profile-info__check-text">Волонтёрство</label>
                        </div>
                    </div>
                </div>
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
            </div>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>