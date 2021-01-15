<?php

namespace tests\unit\models;


use app\models\ResumeForm;
use app\models\ExperienceForm;
use app\tests\unit\fixtures\ExperienceFixture;
use app\tests\unit\fixtures\ResumeFixture as FixturesResumeFixture;


class ResumeFormTest extends \Codeception\Test\Unit
{
    use \Codeception\Specify;

    /** @specify */
    private $resume;

    /**
     * @var \UnitTester
     */
    protected $tester;

    
    public function _before()
    {
        $this->tester->haveFixtures([
            'resumes' => FixturesResumeFixture::className(),
            'experiences' => ExperienceFixture::className(),
        ]);
    }

    public function testResumeFormFieldValidate()
    {
        $this->resume = new ResumeForm();

        $this->specify("name is required", function() {
            $this->resume->name = null;
            $this->assertFalse($this->resume->validate(['name']));
        });

        $this->specify('To long name', function() {
            $this->resume->name = 'toooolllllllloooooooooooonnnnnnnnnngggggggggNNNNNaaaaaaaaaammmmmmmmmeeeeeeee';
            $this->assertFalse($this->resume->validate(['name']));
        });

        $this->specify("name is ok", function() {
            $this->resume->name = 'valentin';
            $this->assertTrue($this->resume->validate(['name']));
        });
    }

    /**
     * Проверяет существует ли запись в бд
     * если да, то фикстура загружена, но пока без проверки загрузки файла
     * Эту фичу реализовать позже TODO:// 
     */
    public function testCreateResume()
    {   
        //получили фикстуру
        $resumeF = $this->tester->grabFixture('resumes', 'resume0');

        //проверяем данные в фикстуре
        $this->assertEquals('Доронин', $resumeF->surname);
        
        //сравниваем данные фикстуры с данными в базе
        $this->assertTrue(ResumeForm::find()->where(['email' => 'aksenova.svetlana@ya.ru'])->exists(), 'Запись не найдена');
        $this->assertTrue(ResumeForm::find()->where(['id' => 1])->exists(), 'Запись не найдена');
        
        
        $model = new ResumeForm([
            // 'file' => сюда передать файл
            'image' => '1592745972_4.jpg',
            'surname' => 'Доронин',
            'name' => 'Виктория',
            'patronymic' => 'Романович',
            'birthday' => '2006-09-19 21:09:51',
            'gender' => 1,
            'city' => 3,
            'email' => 'rdementev@narod.ru',
            'phone' => '+2 074 534-24-21',
            'specialization' => 3,
            'desired_salary' => 83651,
            'employment' => 2,
            'schedule' => 3,
            'experience' => 0,
            'about' => 'Porro est id voluptates laborum. Sunt quia fugiat repudiandae doloribus sit. Voluptates nesciunt aut perferendis voluptatem maxime iste. Occaecati sint iste placeat molestias. Dolorem numquam facilis architecto. Odio consequatur et qui dolorem a. Nemo sed ex quo velit repudiandae in nam. Eum natus consequatur magnam velit est minus ut. Repellat dolor et fugit. Ullam et non dolores vitae veritatis a autem. Et sapiente error eos voluptas. Est saepe quia dolorem necessitatibus commodi voluptates at. Aperiam voluptatum porro et. Veniam ducimus iure exercitationem adipisci ut omnis. Dolore totam totam et quidem. Aliquid eius tempore enim aspernatur corporis quia. Laudantium rerum corrupti in maiores facilis repellat rerum. Quasi enim animi in ad. Minus deleniti libero quia impedit consequatur libero assumenda. Accusantium at amet molestiae provident officiis. Dolore rerum nesciunt commodi occaecati aliquid. Quia beatae nisi nulla voluptatem expedita nihil. Repellat at qui dolor adipisci unde excepturi excepturi. Nisi ex dolor incidunt nobis laborum quaerat. Veritatis nihil dolor nobis quia ea eveniet ut illo. Asperiores vitae eius aliquid et vel voluptas eum. Dolor quasi error ea adipisci ad. Repudiandae aut fugiat numquam quibusdam aut enim quidem maiores. Mollitia aliquid enim consequuntur est ratione. Porro sint possimus pariatur officia vel sit. Quo iusto velit vel hic laudantium incidunt illum. Temporibus mollitia ut reiciendis vel rem ad. Est qui ratione adipisci consectetur. Voluptatem in ut quod est et. Et voluptate consequatur tempora. Eius et aut et accusantium corrupti. Natus non distinctio voluptatem ea. Temporibus et aut libero rerum minima alias. Sapiente nihil nihil est molestiae. Aut porro dolorem error ea. Reiciendis aperiam deleniti in autem cumque exercitationem.',
            'viewed' => 43,
            'published_at' => '2016-08-21 21:58:24',
            'updated_at' => '1979-12-21 14:31:02',
            ]);
            
        expect('image should validate', $model->validate('image'))->true();
        expect('surname should validate', $model->validate('surname'))->true();
        expect('name should validate', $model->validate('name'))->true();
        expect('patronymic should validate', $model->validate('patronymic'))->true();
        expect('birthday should validate', $model->validate('birthday'))->true();
        expect('gender should validate', $model->validate('gender'))->true();
        expect('city should validate', $model->validate('city'))->true();
        expect('email should validate', $model->validate('email'))->true();
        expect('phone should validate', $model->validate('phone'))->true();
        expect('specialization should validate', $model->validate('specialization'))->true();
        expect('desired_salary should validate', $model->validate('desired_salary'))->true();
        expect('employment should validate', $model->validate('employment'))->true();
        expect('schedule should validate', $model->validate('schedule'))->true();
        expect('experience should validate', $model->validate('experience'))->true();
        expect('about should validate', $model->validate('about'))->true();
        expect('viewed should validate', $model->validate('viewed'))->true();
        expect('published_at should validate', $model->validate('published_at'))->true();
        expect('updated_at should validate', $model->validate('updated_at'))->true();
        /*************
         Проверку на сохранение модели пока непонятно как реализовать
         так как не разобрался как передать в тест файл
         
         expect('model should save', $model->save())->true();
         **************/
    }
    
    public function testCreateExperience()
    {
        //получили фикстуру
        $experienceF = $this->tester->grabFixture('experiences', 'experience0');

        //проверяем данные в фикстуре
        $this->assertEquals('corrupti', $experienceF->organization);

        //сравниваем данные фикстуры с данными в базе
        $this->assertTrue(ExperienceForm::find()->where(['id' => 1])->exists(), 'Запись не найдена');

        $model_exp = new ExperienceForm([
            'month' => 10,
            'year' => '1970',
            'month_end_work' => 4,
            'year_end_work' => '1979',
            'until_now_work' => false,
            'organization' => 'corrupti',
            'exp_spec' => 26,
            'responsibility' => 'Et illo excepturi rerum distinctio rerum. Quia quasi consectetur et explicabo. Quos perspiciatis cumque qui ut est accusantium dignissimos laboriosam. Nisi omnis culpa voluptatem. A similique possimus ratione voluptates libero eius. Ut rerum et assumenda ut repudiandae.',
            'resume_id' => 1,
        ]);

        expect('month should validate', $model_exp->validate('month'))->true();
        expect('year should validate', $model_exp->validate('year'))->true();
        expect('month_end_work should validate', $model_exp->validate('month_end_work'))->true();
        expect('year_end_work should validate', $model_exp->validate('year_end_work'))->true();
        expect('until_now_work should validate', $model_exp->validate('until_now_work'))->true();
        expect('organization should validate', $model_exp->validate('organization'))->true();
        expect('exp_spec should validate', $model_exp->validate('exp_spec'))->true();
        expect('responsibility should validate', $model_exp->validate('responsibility'))->true();
        expect('resume_id should validate', $model_exp->validate('resume_id'))->true();

        expect('model should save', $model_exp->save())->true();
    }
    
}