<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ExperienceForm is the model behind the resume form.
 */
class ExperienceForm extends Model
{
    public $month;              // начало работы месяц (может быть несколько) array
    public $year;               // начало работы год (может быть несколько) array
    public $month_end_work;     // конец работы месяц (может быть несколько) array
    public $year_end_work;      // конец работы год (может быть несколько) array
    public $until_now_work;      // по настоящее время (может быть несколько) array
    public $organization;       // организация где работал(а) (может быть несколько) array
    public $exp_spec;           // должность (может быть несколько) array
    public $responsibility;     // функции, достижения (может быть несколько) array

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields
            [['month', 'year',  'organization', 'exp_spec', 'responsibility'], 'required'],
            [['year', 'year_end_work'], 'checkRange']

        ];
    }

    public function checkRange($attr) {
        $start = 1990;
        $end = date ( 'Y' );

        if($this->attr < $start || $this->attr > $end) {
            $this->addError($attr, 'Разрешенный диапазон от 1900 до текущего года');
        }
    }

}