<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Редактирование резюме';
?>

<div class="content p-rel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb40"><a href="/myresume"><img src="/images/blue-left-arrow.svg" alt="arrow"> Вернуться без
                        сохранения</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title mb24"><?= $this->title ?></div>
                </div>
            </div>
            <div class="col-12">
                <!-- resume form -->
                <?php $form = ActiveForm::begin(['id' => 'resume-update', 'action' => '/myresume/update/' . $model->id,  'options' => ['enctype' => 'multipart/form-data']]); ?>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фото</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-foto-upload mb8">
                                <img src="<?= $model->image ?>" alt="foto">
                            </div>
                            <label class="custom-file-upload">

                                <?= $form->field($model, 'image', ['enableLabel' => false])
                                    ->textInput(['type' => 'hidden', 'value' => $model->image]) ?>
                                <?= $form->field($model, 'file', ['enableLabel' => false])->fileInput() ?>

                                Изменить фото
                            </label>
                        </div>
                    </div>

                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фамилия</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">

                            <?= $form->field($model, 'surname', ['enableLabel' => false])
                                ->textInput(['class' => 'dor-input w100']) ?>

                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Имя</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">

                            <?= $form->field($model, 'name', ['enableLabel' => false])
                                ->textInput(['class' => 'dor-input w100']) ?>

                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Отчество</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">

                            <?= $form->field($model, 'patronymic', ['enableLabel' => false])
                                ->textInput(['class' => 'dor-input w100']) ?>

                        </div>
                    </div>
                    <!-- дата рождения -->
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Дата рождения</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="datepicker-wrap input-group date">

                                <?= $form->field($model, 'birthday', ['enableLabel' => false])
                                    ->textInput(['class' => 'dor-input dpicker datepicker-input']) ?>

                                <img src="/images/mdi_calendar_today.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- пол -->
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Пол</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <ul class="card-ul-radio profile-radio-list">
                                
                                <?= $form->field($model, 'gender', ['enableLabel' => false])
                                    ->radioList([
                                        'Мужской' => 'Мужской',
                                        'Женский' => 'Женский'
                                    ], ['item' => function($index = 0, $label, $name, $checked, $value){
                                        ($checked == '1') ? $checked = 'checked="' . $checked . '"' : $checked = '' ;
                                        $answer = '<li><input type="radio" id="test'. ++$index .'" name="'. $name .'" ' .$checked.' value="'. $value .'"> ';
                                        $answer .= ($index == 1) ? '<label for="test'. $index .'">Мужской</label>' : '<label for="test'. $index .'">Женский</label></li>';
                                        return $answer;
                                    }]) ?>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- города -->
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Город проживания</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="citizenship-select">

                                <?= $form->field($model, 'city', ['enableLabel' => false])
                                    ->dropDownList([
                                        'Москва' => 'Москва',
                                        'Самара' => 'Самара',
                                        'Волгоград' => 'Волгоград',
                                        'Екатеринбург' => 'Екатеринбург',
                                        'Тюмень' => 'Тюмень',
                                        'Сочи' => 'Сочи',
                                        'Краснодар' => 'Краснодар',
                                    ], ['class' => 'nselect-2']) ?>

                            </div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="heading">Способы связи</div>
                        </div>
                        <div class="col-lg-7 col-10"></div>
                    </div>
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Электронная почта</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">

                                <?= $form->field($model, 'email', ['enableLabel' => false])
                                    ->input('email', ['class' => 'dor-input w100']) ?>

                            </div>
                        </div>
                    </div>
                    <!-- телефон -->
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Телефон</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div style="width: 140px;" class="p-rel mobile-w100">

                                <?= $form->field($model, 'phone', ['enableLabel' => false])
                                    ->input('phone', [
                                            'class' => 'dor-input w100', 
                                            'placeholder' => '+7 ___ ___-__-__',
                                            'pattern' => '^\+[0-9]{1} [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}$'
                                            ])?>

                            </div>
                        </div>
                    </div>
                    <!-- желаемая должность -->
                    <div class="row mb24">
                        <div class="col-12">
                            <div class="heading">Желаемая должность</div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Специализация</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="citizenship-select">

                                <?= $form->field($model, 'specialization', ['enableLabel' => false])
                                    ->dropDownList([
                                        'Администратор баз данных' => 'Администратор баз данных',
                                        'Аналитик' => 'Аналитик',
                                        'Арт-директор' => 'Арт-директор',
                                        'Инженер' => 'Инженер',
                                        'Компьютерная безопасность' => 'Компьютерная безопасность',
                                        'Контент' => 'Контент',
                                        'Маркетинг' => 'Маркетинг',
                                        'Мультимедиа' => 'Мультимедиа',
                                        'Оптимизация сайта (SEO)' => 'Оптимизация сайта (SEO)',
                                        'Передача данных и доступ в интернет' => 'Передача данных и доступ в интернет',
                                        'Программирование, Разработка' => 'Программирование, Разработка',
                                        'Продажи' => 'Продажи',
                                        'Продюсер' => 'Продюсер',
                                        'Развитие бизнеса' => 'Развитие бизнеса',
                                        'Системный администратор' => 'Системный администратор',
                                        'Системы управления предприятием (ERP)' => 'Системы управления предприятием (ERP)',
                                        'Сотовые, Беспроводные технологии' => 'Сотовые, Беспроводные технологии',
                                        'Стартапы' => 'Стартапы',
                                        'Телекоммуникации' => 'Телекоммуникации',
                                        'Тестирование' => 'Тестирование',
                                        'Технический писатель' => 'Технический писатель',
                                        'Управление проектами' => 'Управление проектами',
                                        'Электронная коммерция' => 'Электронная коммерция',
                                        'CRM системы' => 'CRM системы',
                                        'Web инженер' => 'Web инженер',
                                        'Web мастер' => 'Web мастер'
                                    ], ['class' => 'nselect-1']) ?>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Зарплата</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">

                                <?= $form->field($model, 'desired_salary', ['enableLabel' => false])
                                    ->textInput(['class' => 'dor-input w100', 'placeholder' => 'От']) ?>

                                <img class="rub-icon" src="/images/rub-icon.svg" alt="rub-icon">
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">Занятость</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">

                                <?= $form->field($model, 'employment', ['enableLabel' => false])
                                    ->checkboxList([
                                        'Полная занятость' => 'Полная занятость',
                                        'Частичная занятость' => 'Частичная занятость',
                                        'Проектная/Временная работа' => 'Проектная/Временная работа',
                                        'Волонтёрство' => 'Волонтёрство',
                                        'Стажировка' => 'Стажировка'
                                    ],['item' => function($index, $label, $name, $checked, $value){
                                        ($checked == '1') ? $checked = 'checked="' . $checked . '"' : $checked = '' ;
                                        $answer = '<div class="form-check d-flex">';
                                        $answer .= '<input type="checkbox" name="' . $name . '" class="form-check-input" id="employmentCheck'. ++$index .'" value="' . $value . '" ' . $checked . '> ';
                                        $answer .= '<label class="form-check-label" for="employmentCheck'. $index .'"></label>';
                                        $answer .= '<label class="profile-info__check-text job-resolution-checkbox" for="employmentCheck'. $index .'">' . $label . '</label>';
                                        $answer .= '</div>';
                                        return $answer;
                                    }]) ?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">График работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">

                                <?= $form->field($model, 'schedule', ['enableLabel' => false])
                                    ->checkboxList([
                                        'Полный день' => 'Полный день',
                                        'Сменный график' => 'Сменный график',
                                        'Гибкий график' => 'Гибкий график',
                                        'Удалённая работа' => 'Удалённая работа',
                                        'Вахтовый метод' => 'Вахтовый метод'
                                    ],['item' => function($index, $label, $name, $checked, $value){
                                        ($checked == '1') ? $checked = 'checked="' . $checked . '"' : $checked = '' ;
                                        $answer = '<div class="form-check d-flex">';
                                        $answer .= '<input type="checkbox" name="' . $name . '" class="form-check-input" id="scheduleCheck'. ++$index .'" value="' . $value . '" ' . $checked . '> ';
                                        $answer .= '<label class="form-check-label" for="scheduleCheck'. $index .'"></label>';
                                        $answer .= '<label class="profile-info__check-text job-resolution-checkbox" for="scheduleCheck'. $index .'">' . $label . '</label>';
                                        $answer .= '</div>';
                                        return $answer;
                                    }]) ?>

                            </div>
                        </div>
                    </div>

                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Опыт работы</div>
                        </div>
                    </div>
                    <div class="row mb32" id="exp">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">Опыт работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <ul class="card-ul-radio profile-radio-list">

                                <?= $form->field($model, 'experience', ['enableLabel' => false])
                                    ->radioList([
                                        'Нет опыта работы' => 'Нет опыта работы',
                                        'Есть опыт работы' => 'Есть опыт работы'
                                    ], ['item' => function($index, $label, $name, $checked, $value){
                                        $answer = '<li><input type="radio" id="test'. ++$index . 'experience" name="'. $name .'" checked="' .$checked.'" value="'. $value .'"> ';
                                        $answer .= '<label for="test'. $index . 'experience">' . $label . '</label></li>';
                                        return $answer;
                                    }]) ?>

                            </ul>
                            
                        </div>
                    </div>


                    <div class="link-delete">
    <!-- начало работы -->
    <div class="row mb24">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Начало работы</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <div class="d-flex justify-content-between">
            <div class="citizenship-select w100 mr16">

            <?= $form->field($model->exp[0], 'month', ['enableLabel' => false])
                ->dropDownList([
                    'Январь' => 'Январь',
                    'Февраль' => 'Февраль',
                    'Март' => 'Март',
                    'Апрель' => 'Апрель',
                    'Май' => 'Май',
                    'Июнь' => 'Июнь',
                    'Июль' => 'Июль',
                    'Август' => 'Август',
                    'Сентябрь' => 'Сентябрь',
                    'Октябрь' => 'Октябрь',
                    'Ноябрь' => 'Ноябрь',
                    'Декабрь' => 'Декабрь',

                ], ['class' => 'nselect-1']) ?>
    
            </div>
            <div class="citizenship-select w100">
                <!-- <input name="year" placeholder="2006" type="text" class="dor-input w100" required> -->
                <?= $form->field($model->exp[0], 'year', ['enableLabel' => false])
                        ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9{4}'])
                        ->textInput(['class' => 'dor-input w100'])
                         ?>
            </div>
        </div>
    </div>
    </div>
    <!-- окончание работы -->
    <div class="row mb8">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Окончание работы</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <div class="d-flex justify-content-between">
            <div class="citizenship-select w100 mr16">

            <?= $form->field($model->exp[0], 'month_end_work', ['enableLabel' => false])
                ->dropDownList([
                    'Январь' => 'Январь',
                    'Февраль' => 'Февраль',
                    'Март' => 'Март',
                    'Апрель' => 'Апрель',
                    'Май' => 'Май',
                    'Июнь' => 'Июнь',
                    'Июль' => 'Июль',
                    'Август' => 'Август',
                    'Сентябрь' => 'Сентябрь',
                    'Октябрь' => 'Октябрь',
                    'Ноябрь' => 'Ноябрь',
                    'Декабрь' => 'Декабрь',

                ], ['class' => 'nselect-1']) ?>
    
            </div>
            <div class="citizenship-select w100">
                <!-- <input name="year_end_work" placeholder="2006" type="text" class="dor-input w100" required> -->
                     <?= $form->field($model->exp[0], 'year_end_work', ['enableLabel' => false])
                        ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9{4}'])
                        ->textInput(['class' => 'dor-input w100'])
                         ?>
            </div>
        </div>
    </div>
    </div>
    <div class="row mb32">
    <div class="col-lg-2 col-md-3">
    </div>
    <div class="col-lg-3 col-md-4 col-11">
        <div class="profile-info">
            <div class="form-check d-flex">

            <?= $form->field($model->exp[0], 'until_now_work', ['enableLabel' => false])
                        ->checkboxList([
                            'По настоящее время' => 'По настоящее время'
                        ],['item' => function($index, $label, $name, $checked, $value){
                            $answer = '<input type="checkbox" name="' . $name . '" class="form-check-input" id="untilCheck'. ++$index .'" value="' . $value . '" ' . $checked . '"> ';
                            $answer .= '<label class="form-check-label" for="untilCheck'. $index .'"></label>';
                            $answer .= '<label class="profile-info__check-text job-resolution-checkbox" for="untilCheck'. $index .'">' . $label . '</label>';
                            return $answer;
                        }]) ?>

            </div>
        </div>
    </div>
    </div>
    <div class="row mb16">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Организация</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">

        <?= $form->field($model->exp[0], 'organization', ['enableLabel' => false])
                ->textInput(['class' => 'dor-input w100'])?>

    </div>
    </div>
    <div class="row mb16">
    <div class="col-lg-2 col-md-3 dflex-acenter">
        <div class="paragraph">Должность</div>
    </div>
    <div class="col-lg-3 col-md-4 col-11">

        <?= $form->field($model->exp[0], 'exp_spec', ['enableLabel' => false])
                ->textInput(['class' => 'dor-input w100'])?>
    </div>
    </div>
    <div class="row mb16">
    <div class="col-lg-2 col-md-3">
        <div class="paragraph">Обязанности, функции, достижения</div>
    </div>
    <div class="col-lg-4 col-md-6 col-12">

        <?= $form->field($model->exp[0], 'responsibility', ['enableLabel' => false])
                ->textarea(['class' => 'dor-input w100 h96 mb8', 
                'placeholder' => 'Расскажите о своих обязанностях, функциях и достижениях'])?>

        <div class="mb24"><a class="delete-work" href="#">Удалить место работы</a></div>
        <div class="add-work"><a id="add-work" href="#" >+ Добавить место работы</a></div>
    </div>
    </div>
    <div class="row mb24">
        <div class="col-lg-2 col-md-3">
        </div>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="devide-border"></div>
        </div>
    </div>
</div>

                    
                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Расскажите о себе</div>
                        </div>
                    </div>
                    <div class="row mb64 mobile-mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">О себе</div>
                        </div>
                        <div class="col-lg-5 col-md-7 col-12">

                            <?= $form->field($model, 'about', ['enableLabel' => false])
                                ->textarea(['class' => 'dor-input w100 h176 mb8'])?>

                        </div>
                    </div>
                    <div class="row mb128 mobile-mb64">
                        <div class="col-lg-2 col-md-3">
                        </div>
                        <div class="col-lg-10 col-md-9">

                            <?= Html::submitButton('Сохранить', 
                            [
                                'class' => 'orange-btn link-orange-btn', 
                                'name' => 'resume-button'
                            ]) ?>
                            
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
                <!-- resume form -->
            </div>
        </div>
    </div>