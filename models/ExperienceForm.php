<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ExperienceForm is the model behind the resume form.
 */
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