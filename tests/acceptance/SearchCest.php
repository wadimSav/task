<?php 


use yii\helpers\Url;
use app\tests\unit\fixtures\ExperienceFixture;
use app\tests\unit\fixtures\ResumeFixture;


class SearchCest
{

    /**
     * Проверяет поиск резюме по городу
     */
    public function citySearch(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->click('.field-city-search');
        $I->see('Волгоград', '.nselect__inner>ul>li>span');
        $I->click(['css' => '.field-city-search>.nselect>.nselect__inner>ul>li[data-val="3"]>span']);
        $I->wait(3);
        // так как в фикстурах у нас 3 резюме с городом под цифрой 3, 
        // ожидаем, что будет найдено всего три резюме
        // но почему-то грузится рабочая база
        // TODO: исправить
        $I->see('Найдено 3 резюме', '.paragraph.mr16');
        $I->seeCurrentUrlEquals('/?city=3');
    }

    /**
     * Проверяет поиск резюме по мужскому полу
     * @depends citySearch
     */
    public function genderMansSearch(AcceptanceTester $I)
    {
        $I->see('Мужчины');
        $I->click('Мужчины');
        $I->seeCurrentUrlEquals('/?gender=1');
    }

    /**
     * Проверяет поиск резюме по женскому полу
     * @depends genderMansSearch
     */
    public function genderVomansSearch(AcceptanceTester $I)
    {
        $I->see('Женщины');
        $I->click('Женщины');
        $I->seeCurrentUrlEquals('/?gender=2');
    }

    /**
     * Проверяет поиск резюме по желаемой зарплате
     * @depends genderVomansSearch
     */
    public function desiredSalarySearch(AcceptanceTester $I)
    {
        $I->seeElement('#salary');
        $I->fillField('#salary', 33000);
        $I->click('.field-spec-search');
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000');
    }

    /**
     * Проверяет поиск резюме по специализации
     * @depends desiredSalarySearch
     */
    public function specializationSearch(AcceptanceTester $I)
    {
        $I->click('.field-spec-search');
        $I->see('Арт-директор', ['css' => '.field-spec-search .nselect__list li[data-val="3"]>span']);
        $I->click(['css' => '.field-spec-search .nselect__list li[data-val="3"]>span']);
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000&specialization=3');
    }

    /**
     * Проверяет поиск резюме по возрасту от и до
     * @depends specializationSearch
     */
    public function ageFromToSearch(AcceptanceTester $I)
    {
        $I->seeElement('#agefrom');
        $I->seeElement('#ageto');

        $I->fillField('#agefrom', 30);
        $I->click('#ageto');
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000&specialization=3&agefrom=30');

        $I->fillField('#ageto', 40);
        $I->click('#agefrom');
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000&specialization=3&agefrom=30&ageto=40');
    }

    /**
     * Проверяет поиск резюме по опыту работы
     * @depends ageFromToSearch
     */
    public function experienceSearch(AcceptanceTester $I)
    {
        $I->seeElement('#resumesearch-experience');
        $I->click(['css' => 'label[for="test2"]']);
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000&specialization=3&agefrom=30&ageto=40&experience=2');
    }

    /**
     * Проверяет поиск резюме по типу занятости
     * @depends experienceSearch
     */
    public function employmentSearch(AcceptanceTester $I)
    {
        $I->seeElement('#resumesearch-employment');
        $I->click(['css' => 'label[for="employmentCheck2"]']);
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000&specialization=3&agefrom=30&ageto=40&experience=2&employment=2');
    }

    /**
     * Проверяет поиск резюме по типу трудоустройства
     * @depends employmentSearch
     */
    public function scheduleSearch(AcceptanceTester $I)
    {
        $I->seeElement('#resumesearch-schedule');
        $I->click(['css' => 'label[for="scheduleCheck3"]']);
        $I->seeCurrentUrlEquals('/?gender=2&desired_salary=33000&specialization=3&agefrom=30&ageto=40&experience=2&employment=2&schedule=3');
    }

    // Запуск селениума
    // java -jar -Dwebdriver.gecko.driver=geckodriver.exe selenium-server-standalone-3.141.59.jar

    // Запуск встроенного сервера
    // "tests/bin/yii" serve

    // Запуск приемочных тестов
    // "vendor/bin/codecept" run acceptance
}
