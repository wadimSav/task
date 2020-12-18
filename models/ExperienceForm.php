<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * ExperienceForm is the model behind the resume form.
 */
class ExperienceForm extends ActiveRecord
{
    // public $month;              // начало работы месяц (может быть несколько) array
    // public $year;               // начало работы год (может быть несколько) array
    // public $month_end_work;     // конец работы месяц (может быть несколько) array
    // public $year_end_work;      // конец работы год (может быть несколько) array
    // public $until_now_work;      // по настоящее время (может быть несколько) array
    // public $organization;       // организация где работал(а) (может быть несколько) array
    // public $exp_spec;           // должность (может быть несколько) array
    // public $responsibility;     // функции, достижения (может быть несколько) array

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{experience}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields
            [['month', 'year',  'organization', 'exp_spec', 'month_end_work', 'year_end_work'], 'required',
              'message' => 'Поле обязательно к заполнению'],

            [['month_end_work', 'responsibility'], 'string'],

            [['resume_id', 'year', 'year_end_work'], 'integer', 'message' => 'Значение должно быть числом'],

            // [['year', 'year_end_work'], 'integer'],
            
            [['until_now_work'], 'default'],

            [['year', 'year_end_work'], 'in', 
              'range' => range(1900, (integer) Yii::$app->formatter->asDate('now', 'php:Y')), 
              'message' => 'Разрешенный диапазон от 1900 до текущего года'],

        ];
    }

    public function getResume()
    {
       return $this->hasOne(ResumeForm::className(), ['id' => 'resume_id']);            
    }

}