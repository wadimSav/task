<?php

use yii\widgets\ActiveForm;
use app\models\SearchForm;
use yii\helpers\Html;
use yii\helpers\Url;

$search = new SearchForm();

$this->title = 'Результаты поиска по слову ' . $q;

$this->registerMetaTag([
    'name' => 'description',
    'content' => "Поиск по слову $q."
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => $q
]);
?>
<div class="header-search">
    <div class="container">
        <div class="header-search__wrap">
            <?php $form = ActiveForm::begin(['id' => 'searchForm']); ?>
                <img src="/images/dark-search.svg" alt="search" class="dark-search-icon header-search__icon">
                <?= $form->field($search, 'q')
                    ->textInput(['class' => 'header-search__input w100'])
                    ->label(false); ?>
                <?= Html::button('Найти', [
                    'class' => 'blue-btn header-search__btn',
                    'type' => 'submit', 'form' => 'searchForm'
                    ]); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="col-lg-9">
            <div class="main-title mb32 mt50 d-flex justify-content-between align-items-center"><?php // $this->title ?>
                <a href="<?= Url::to('@web/create/resume') ?>" class="link-orange-btn orange-btn my-vacancies-add-btn">Добавить резюме</a>
                <a href="<?= Url::to('@web/create/resume') ?>" class="my-vacancies-mobile-add-btn link-orange-btn orange-btn plus-btn">+</a>
            </div>
            <div class="tabs mb64">
                <div class="tabs__content active">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($q == '') { ?>
                                <h2>Вы отправили пустой запрос!</h2>
                            <?php } else { ?>
                                <h2>Результаты поиска: <?= $q ?></h2>
                                <?php if (!$resultSearch) { ?>
                                    <p>ничего не найдено</p>
                                <?php } else { ?>
                                    <?php foreach ($resultSearch as $resume) include '_searchresumelist.php'; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

