<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


class ExperienceForm extends ActiveRecord
{

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
            [['month', 'year',  'organization', 'exp_spec', 'month_end_work', 'year_end_work'], 'required',
              'message' => 'Поле обязательно к заполнению'],

            [['responsibility'], 'string'],

            [['resume_id', 'year', 'year_end_work', 'month_end_work', 'month'], 'integer', 'message' => 'Значение должно быть числом'],

            [['until_now_work'], 'boolean'],
            [['until_now_work'], 'default', 'value' => false],

            [['year', 'year_end_work'], 'in', 
              'range' => range(1900, (integer) Yii::$app->formatter->asDate('now', 'php:Y')), 
              'message' => 'Разрешенный диапазон от 1900 до текущего года'],

        ];
    }

    /**
     * One-to-one relationship with resume table
     */
    public function getResume()
    {
       return $this->hasOne(ResumeForm::className(), ['id' => 'resume_id']);            
    }

}