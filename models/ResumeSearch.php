<?php

namespace app\models;

use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\VarDumper;

class ResumeSearch extends ResumeForm
{

    public $ageto;
    public $agefrom;

    public function rules()
    {
        // только поля определенные в rules() будут доступны для поиска
        return [
            [['specialization', 
            'employment', 
            'schedule', 
            'gender', 
            'city', 
            'desired_salary',
            'experience',
            ], 'integer'],

            [['ageto', 'agefrom'], 'in', 'range' => range(20, 60), 
            'message' => 'Значение должно быть от 20 до 60']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ResumeForm::find()->joinWith('exp');
        
        $listResume = new ActiveDataProvider([
            'query' => $query,
            ]);

        $searchParam = $params;

        $query->andFilterWhere(['gender' => $searchParam['gender']]);
        $query->andFilterWhere(['city' => $searchParam['city']]);
        $query->andFilterWhere(['<=', 'desired_salary', $searchParam['desired_salary']]);
        $query->andFilterWhere(['specialization' => $searchParam['specialization']]);

        if (array_key_exists('agefrom', $searchParam) && !array_key_exists('ageto', $searchParam)) {
            $date = new DateTime(-$searchParam['agefrom'] . ' years');
            $age = $date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['<', 'birthday', $age]);
        }
        if (!array_key_exists('agefrom', $searchParam) && array_key_exists('ageto', $searchParam)) {
            $date = new DateTime(-$searchParam['ageto'] . ' years');
            $age = $date->format('Y-m-d H:i:s');
            $query->andFilterWhere(['>', 'birthday', $age]);
        }
        if (array_key_exists('agefrom', $searchParam) && array_key_exists('ageto', $searchParam)) {
            $minDate = new DateTime(-$searchParam['agefrom'] . ' years');
            $minAge = $minDate->format('Y-m-d H:i:s');
            $maxDate = new DateTime(-$searchParam['ageto'] . ' years');
            $maxAge = $maxDate->format('Y-m-d H:i:s');
            $query->andFilterWhere(['between', 'birthday', $maxAge, $minAge]);
        }
        if($searchParam['experience'] == 1){
            $query->andFilterWhere(['experience' => 0]);
        } elseif($searchParam['experience'] == 2){
            $query->andFilterWhere(['between', '(experience.year_end_work) - (experience.year)', 1, 3]);
        } elseif($searchParam['experience'] == 3){
            $query->andFilterWhere(['between', '(experience.year_end_work) - (experience.year)', 3, 6]);
        } elseif($searchParam['experience'] == 4){
            $query->andFilterWhere(['>', '(experience.year_end_work) - (experience.year)', 6]);
        }

        if(isset($searchParam['employment'])){
            $numArray = str_split($searchParam['employment'], 1);
            $query->andFilterWhere(['or like', 'employment', $numArray]);
        }
        if(isset($searchParam['schedule'])){
            $numArray = str_split($searchParam['schedule'], 1);
            $query->andFilterWhere(['or like', 'schedule', $numArray]);
        }
            // ->orderBy(['desired_salary' => SORT_DESC])
            
        return $listResume;
    }
}
