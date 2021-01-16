<?php


use app\tests\unit\fixtures\ExperienceFixture;
use app\tests\unit\fixtures\ResumeFixture;


class ResumeFormCest
{
    // загружаем фикстуры
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'resumes' => ResumeFixture::className(),
            'experiences' => ExperienceFixture::className(),
        ]);
    }
    
    /**
     * Проверяет открытие главной страницы
     */
    public function openFrontPage(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Список резюме', 'h1');
    }
    
    /**
     * Проверяет открытие страницы списка резюме
     */
    public function openMyresumePage(FunctionalTester $I)
    {
        $I->amOnPage('myresume');
        $I->see('Мои резюме', 'h1');
    }

    /**
     * Проверяет открытие страницы создания резюме
     */
    public function openCreateResumePage(FunctionalTester $I)
    {
        $I->amOnPage('create/resume');
        $I->see('Новое резюме', '.main-title');
    }
    
    /**
     * Проверяет, можно ли создать резюме отправив пустую форму
     */
    public function createWithEmptyCredentials(FunctionalTester $I)
    {
        $I->amOnPage('create/resume');
        $I->submitForm('#resume-form', []);
        $I->expectTo('see validations errors');
        $I->see('Поле обязательно к заполнению', '.help-block');
        // $I->see('Пожалуйста, загрузите Ваше фото', '.help-block');
        // $I->see('Укажите пожалуйста вашу дату рождения', '.help-block');
    }

    /**
     * Проверяет, можно ли создать резюме отправив правильно заполненную форму
     */
    public function createWithNormalData(FunctionalTester $I)
    {
        $I->amOnPage('create/resume');

        $I->attachFile('#resumeform-file', 'экран.png');

        $I->fillField(['name' => 'ResumeForm[name]'], 'Вася');
        $I->fillField(['name' => 'ResumeForm[surname]'], 'Пупкин');
        $I->fillField(['name' => 'ResumeForm[patronymic]'], 'Чей-то там');
        $I->fillField(['name' => 'ResumeForm[email]'], 'tratata@ya.ru');
        $I->fillField(['name' => 'ResumeForm[phone]'], '+7 950 135-15-25');
        $I->fillField(['name' => 'ResumeForm[desired_salary]'], 35000);
        $I->fillField(['name' => 'ResumeForm[birthday]'], '2010-10-10 00:00:00');
        $I->fillField(['name' => 'ResumeForm[about]'], 'dgdgxdhfgsgxdhf');
        $I->fillField(['name' => 'ExperienceForm[year]'], '1970');
        $I->fillField(['name' => 'ExperienceForm[year_end_work]'], '1980');
        $I->fillField(['name' => 'ExperienceForm[organization]'], 'ТопСайтс');

        $I->selectOption('#resumeform-gender input[name="ResumeForm[gender]"]', 1);
        $I->selectOption('#resumeform-city', 3);
        $I->selectOption('#resumeform-specialization', 10);
        $I->selectOption('#resumeform-employment input[name="ResumeForm[employment][]"]', 1,3);
        $I->selectOption('#resumeform-schedule [name="ResumeForm[schedule][]"]', 2);
        $I->selectOption('#resumeform-experience input[name="ResumeForm[experience]"]', 1);
        
        $I->submitForm('#resume-form', []);

        $I->expectTo('dont see error messages');

        $I->dontSee('Поле обязательно к заполнению', '.help-block');
        $I->dontSee('Пожалуйста, загрузите Ваше фото', '.help-block');
        $I->dontSee('Укажите пожалуйста вашу дату рождения', '.help-block');
        $I->dontSee('Проверьте правильность введенного номера по шаблону +7 ___ ___-__-__', '.help-block');
        $I->dontSee('Значение не должно быть отрицательным и превышать 500000', '.help-block');
        $I->dontSee('Ведите правильный адрес почтового ящика', '.help-block');
        // $I->see('Мои резюме', 'h1');
    }

    /**
     * Проверяет удаление резюме
     */
    public function deleteResume(FunctionalTester $I)
    {
        $I->amOnPage('myresume');
        $I->seeRecord('\app\models\ResumeForm', ['surname' => 'Доронин']);
        $I->click('#dropdownMenuLink');
        $I->seeLink('Удалить', 'myresume/delete/1');
        $I->click('Удалить');
        $I->see('Мои резюме', 'h1');
        $I->dontSeeLink('Удалить', 'myresume/delete/1');
        $I->dontSeeLink('Редактировать', 'myresume/edit/1');
    }

    /**
     * проверяет редактирование резюме
     */
    public function openEditResumePage(FunctionalTester $I)
    {
        $I->amOnPage('myresume');
        $I->seeRecord('\app\models\ResumeForm', ['surname' => 'Доронин']);
        $I->click('#dropdownMenuLink');
        $I->seeLink('Редактировать', 'myresume/edit/1');
        $I->click('Редактировать');
        $I->see('Редактирование резюме', '.main-title');

    }
    
    /**
     * Проверяет открытие страницы просмотра одного резюме
     */
    public function openDetailResumePage(FunctionalTester $I)
    {
        $I->amOnPage('myresume');
        $I->seeRecord('\app\models\ResumeForm', ['surname' => 'Доронин']);
        $I->seeLink('Открыть', 'myresume/detail/1');
        $I->click('Открыть');
        $I->see('Арт-директор', '.main-title');
    }
    
    /**
     * Проверяет обновление резюме
     */
    public function updateResume(FunctionalTester $I)
    {
        $I->amOnPage('myresume/edit/1');
        $I->see('Редактирование резюме', '.main-title');
        $I->attachFile('#resumeform-file', 'экран.png');
        
        $I->fillField(['name' => 'ResumeForm[name]'], 'Вася');
        $I->fillField(['name' => 'ResumeForm[surname]'], 'Пупкин');
        $I->fillField(['name' => 'ResumeForm[patronymic]'], 'Чей-то там');
        $I->fillField(['name' => 'ResumeForm[email]'], 'tratata@ya.ru');
        $I->fillField(['name' => 'ResumeForm[phone]'], '+7 950 135-15-25');
        $I->fillField(['name' => 'ResumeForm[desired_salary]'], 35000);
        $I->fillField(['name' => 'ResumeForm[birthday]'], '2010-10-10 00:00:00');
        $I->fillField(['name' => 'ResumeForm[about]'], 'dgdgxdhfgsgxdhf');
        $I->fillField(['name' => 'ExperienceForm[year]'], '1970');
        $I->fillField(['name' => 'ExperienceForm[year_end_work]'], '1980');
        $I->fillField(['name' => 'ExperienceForm[organization]'], 'ТопСайтс');
        
        $I->selectOption('#resumeform-gender input[name="ResumeForm[gender]"]', 1);
        $I->selectOption('#resumeform-city', 3);
        $I->selectOption('#resumeform-specialization', 10);
        $I->selectOption('#resumeform-employment input[name="ResumeForm[employment][]"]', 1,3);
        $I->selectOption('#resumeform-schedule [name="ResumeForm[schedule][]"]', 2);
        $I->selectOption('#resumeform-experience input[name="ResumeForm[experience]"]', 1);
        
        $I->submitForm('#resume-update', []);
        
        $I->dontSee('Поле обязательно к заполнению', '.help-block');
        $I->dontSee('Пожалуйста, загрузите Ваше фото', '.help-block');
        $I->dontSee('Укажите пожалуйста вашу дату рождения', '.help-block');
        $I->dontSee('Проверьте правильность введенного номера по шаблону +7 ___ ___-__-__', '.help-block');
        $I->dontSee('Значение не должно быть отрицательным и превышать 500000', '.help-block');
        $I->dontSee('Ведите правильный адрес почтового ящика', '.help-block');
        $I->dontSee('Редактирование резюме', '.main-title');
        
        $I->see('Мои резюме', 'h1');
    }
    
    /**
     * Проверяет, можно ли обновить резюме отправив пустое поле
     */
    public function updateWithEmptyCredentials(FunctionalTester $I)
    {
        $I->amOnPage('myresume/edit/1');
        $I->fillField(['name' => 'ResumeForm[name]'], '');
        $I->submitForm('#resume-update', []);
        $I->expectTo('see validations errors');
        $I->see('Поле обязательно к заполнению', '.help-block');

        // "vendor/bin/codecept" run functional ResumeFormCest
    }

}
