<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * ResumeForm is the model behind the resume form.
 */
class ResumeForm extends ActiveRecord
{

    public $file; 

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{resume}}';
    }


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields
            [['surname',  'name', 'patronymic', 'gender',
              'city', 'email', 'phone', 'specialization', 'desired_salary', 
              'employment', 'schedule'], 'required',
              'message' => 'Поле обязательно к заполнению'],

              // Номер телефона
              ['phone', 'match', 'pattern' => '/^\+[0-9]{1} [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}$/',
               'message' => 'Проверьте правильность введенного номера по шаблону +7 ___ ___-__-__'],

              ['file', 'required', 'message' => 'Пожалуйста, будьте открытым, загрузите Ваше фото'],

              // День рождения
              ['birthday', 'required', 'message' => 'Укажите пожалуйста вашу дату рождения'],

              [['image', 'about', 'experience'], 'string'],

              [['viewed', 'updated_at'], 'default'],
              
              // Желаемая зарплата
              ['desired_salary', 'in', 'range' => range(0, 500000), 
              'message' => 'Значение не должно быть отрицательным и превышать 500000'],

              [['file', 'image'], 'safe'],

              // email has to be a valid email address
              ['email', 'email', 'message' => 'Ведите правильный адрес почтового ящика'],
              // [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg']

        ];
    }


    /**
     * Связь с таблицей experience
     */
    public function getExp()
    {
       return $this->hasMany(ExperienceForm::className(), ['resume_id' => 'id']);            
    }


    /**
     * Установка времени создания и обновления записи
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['published_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() { return Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s'); } // unix timestamp },
            ]
        ];
    }

    public function my_ucfirst($string, $e ='utf-8') { 
        if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) { 
            $string = mb_strtolower($string, $e); 
            $upper = mb_strtoupper($string, $e); 
                preg_match('#(.)#us', $upper, $matches); 
                $string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $e), $e); 
        } 
        else { 
            $string = ucfirst($string); 
        } 
        return $string; 
    }

    public function num2word($num, $words)
    {
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }
        switch ($num) {
            case 1: {
                return($words[0]);
            }
            case 2: case 3: case 4: {
                return($words[1]);
            }
            default: {
                return($words[2]);
            }
        }
    }

}