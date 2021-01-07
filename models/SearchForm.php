<?php

namespace app\models;

use yii\base\Model;

/**
 * Форма поиска по сайту
 */
class SearchForm extends Model
{

    public $q;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // request param
            ['q', 'string']
        ];
    }
}
