<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ResumeForm is the model behind the resume form.
 */
class ResumeForm extends Model
{
    public $image;              // картинка file
    public $surname;            // фамилия str
    public $name;               // имя str
    public $patronymic;         // отчество str
    public $date_of_birth;      // дата рождения date
    public $gender;             // пол str
    public $city;               // город str
    public $email;              // почта str
    public $phone;              // телефон str
    public $specialization;     // специализация str
    public $desired_salary;     // желаемая зарплата int
    public $employment;         // занятость str
    public $schedule;           // график работы str
    public $experience;         // опыт работы bool

    // если есть опыт работы делаем запись в таблицу experience
    // и делаем связь по resume_id


    public $about;              // о себе str



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields
            [['image', 'surname',  'name', 'patronymic', 'date_of_bird', 'gender',
              'city', 'email', 'phone', 'specialization', 'desired_salary', 
              'employment', 'schedule', 'experience'], 'required'],
              [['date_of_bird'], 'date', 'format' => 'php:Y-m-d'],
            // email has to be a valid email address
            ['email', 'email'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']

        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('/images' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array customized attribute labels
     */
    // public function attributeLabels()
    // {
    //     return [
    //         'verifyCode' => 'Verification Code',
    //     ];
    // }
}