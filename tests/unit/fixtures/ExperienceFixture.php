<?php
namespace app\tests\unit\fixtures;

use yii\test\ActiveFixture;

class ExperienceFixture extends ActiveFixture
{
    public $modelClass = 'app\models\ExperienceForm';
    public $depends = ['app\tests\unit\fixtures\ResumeFixture'];
}