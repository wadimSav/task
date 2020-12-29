<?php

use app\models\enums\Cities;
use app\models\enums\Employment;
use app\models\enums\ExpSearchInd;
use app\models\enums\Shedule;
use app\models\enums\Specialist;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'method' => 'get',
    'id' => 'searcher'
]); ?>

<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">Город</div>
    <div class="citizenship-select">
        <?= $form->field($model, 'city')
             ->dropDownList(Cities::listData(), [
                 'class' => 'nselect-4', 
                 'id' => 'city-search',
                 ])->label(false) ?>
        
    </div>
</div>

<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">Зарплата</div>
    <div class="p-rel">
        <!-- <input placeholder="Любая" type="text" class="dor-input w100" id="salary"> -->
        <?= $form->field($model, 'desired_salary')
                 ->textInput(['id' => 'salary', 'class' => 'dor-input w100', 'placeholder' => 'Любая'])
                 ->label(false) ?>

        <img class="rub-icon" src="/images/rub-icon.svg" alt="rub-icon">
    </div>
</div>
<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">Специализация</div>
    <div class="citizenship-select">
    <?= $form->field($model, 'specialization')
             ->dropDownList(Specialist::listData(), [
                 'class' => 'nselect-3', 
                 'id' => 'spec-search',
                 ])->label(false) ?>
    </div>
</div>

<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">Возраст</div>
    <div class="d-flex">
        <?= $form->field($model, 'agefrom')
            ->textInput([
                'id' => 'agefrom', 
                'class' => 'dor-input w100', 
                'placeholder' => 'От'
            ])->label(false) ?>

        <?= $form->field($model, 'ageto')
            ->textInput([
                'id' => 'ageto', 
                'class' => 'dor-input w100', 
                'placeholder' => 'До'
            ])->label(false) ?>
    </div>
</div>
<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">Опыт работы</div>
    <div class="profile-info">
        <ul class="card-ul-radio profile-radio-list">
         <?= $form->field($model, 'experience')
            ->radioList(
                ExpSearchInd::listData(),
                ['item' => function($index, $label, $name, $checked, $value){
                $answer = '<li><input type="radio" id="test'. ++$index .'" name="'. $name .'" value="'. $value .'"> ';
                $answer .= '<label for="test'. $index .'">' . $label . '</label></li>';
                return $answer;
            }])->label(false) ?>
        </ul>
    </div>
</div>

<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">Тип занятости</div>
    <div class="profile-info">
        <?= $form->field($model, 'employment')
        ->checkboxList(
            Employment::listData(),
        ['item' => function($index, $label, $name, $checked, $value){
            $answer = '<div class="form-check d-flex">';
            $answer .= '<input type="checkbox" name="' . $name . '" class="form-check-input" id="employmentCheck'. ++$index .'" value="' . $value . '"> ';
            $answer .= '<label class="form-check-label" for="employmentCheck'. $index .'"></label>';
            $answer .= '<label class="profile-info__check-text job-resolution-checkbox" for="employmentCheck'. $index .'">' . $label . '</label>';
            $answer .= '</div>';
            return $answer;
        }])->label(false) ?>
    </div>
</div>

<div class="vakancy-page-filter-block__row mb24">
    <div class="paragraph cadet-blue">График работы</div>
    <div class="profile-info">
        <?= $form->field($model, 'schedule')
            ->checkboxList(
                Shedule::listData(),
            ['item' => function($index, $label, $name, $checked, $value){
                $answer = '<div class="form-check d-flex">';
                $answer .= '<input type="checkbox" name="' . $name . '" class="form-check-input" id="scheduleCheck'. ++$index .'" value="' . $value . '"> ';
                $answer .= '<label class="form-check-label" for="scheduleCheck'. $index .'"></label>';
                $answer .= '<label class="profile-info__check-text" for="scheduleCheck'. $index .'">' . $label . '</label>';
                $answer .= '</div>';
                return $answer;
            }])->label(false) ?>
        
    </div>
</div>

<?php ActiveForm::end(); ?>
