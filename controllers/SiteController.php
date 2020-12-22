<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ResumeForm;
use app\models\ExperienceForm;
use Faker\Factory;
use yii\helpers\VarDumper;
use yii\web\UploadedFile as WebUploadedFile;
use yii\data\ActiveDataProvider;
use yii\data\Sort;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     */
    public function actionIndex()
    {
        $cities = ResumeForm::find()->select('city')->all();
        $listResume = new ActiveDataProvider([
            'query' => ResumeForm::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        // VarDumper::dump($cities, 5, true);

        return $this->render('index', [
            'listResume' => $listResume,
            'cities' => $cities,
        ]);
    }

    /**
     * Displays homepage.
     *
     */
    public function actionMan()
    {
        $cities = ResumeForm::find()->select('city')->all();
        $listResume = new ActiveDataProvider([
            'query' => ResumeForm::find()->where(['gender' => 'Мужской']),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'listResume' => $listResume,
            'cities' => $cities,
        ]);
    }

    /**
     * Displays homepage.
     *
     */
    public function actionWoman()
    {
        $cities = ResumeForm::find()->select('city')->all();
        $listResume = new ActiveDataProvider([
            'query' => ResumeForm::find()->where(['gender' => 'Женский']),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'listResume' => $listResume,
            'cities' => $cities,
        ]);
    }

    /**
     * Pjax выборка  / города
     *
     */
    public function actionCity($city)
    {
        $cities = ResumeForm::find()->select('city')->all();
        $listResume = new ActiveDataProvider([
            'query' => ResumeForm::find()->where(['city' => $city]),

            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'listResume' => $listResume,
            'cities' => $cities,
        ]);
    }

    /**
     * Pjax выборка  / зарплата
     *
     */
    public function actionSalary($salary)
    {
        $cities = ResumeForm::find()->select('city')->all();
        $listResume = new ActiveDataProvider([
            'query' => ResumeForm::find()->where(['between', 'desired_salary', 1, $salary]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->renderAjax('index', [
            'listResume' => $listResume,
            'cities' => $cities,
        ]);
    }

    /**
     * Delete resume and related entries.
     *
     */
    public function actionDelete($id)
    {
        $resume = ResumeForm::findOne($id);
        $resume->delete();

        return $this->redirect(['myresume']);
    }

    /**
     * Displays detail page.
     *
     */
    public function actionDetail($id)
    {
        $oneResume = ResumeForm::findOne($id);

        return $this->render('/site/detail', [
            'resume' => $oneResume,
        ]);
    }

    /**
     * Displays myresume page.
     *
     */
    public function actionMyresume()
    {
        $resumeList = new ActiveDataProvider([
            'query' => ResumeForm::find()->with('exp'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('/site/myresume', [
            'resumeList' => $resumeList
        ]);
    }

    /**
     * Displays create resume form page.
     *
     */
    public function actionCreate()
    {

        $model = new ResumeForm();
        $model_exp = new ExperienceForm();

        if ($model->load(Yii::$app->request->post()) && $model_exp->load(Yii::$app->request->post())) {

            $model->file = WebUploadedFile::getInstance($model, 'file');

            if ($model->validate('file')) {
                $model->file->saveAs('images/' . $model->file->name);
                $model->image = $model->file->name;
            }

            $model->employment = $model->employment[0];
            $model->schedule = $model->schedule[0];

            if ($model->save() && $model_exp->load(Yii::$app->request->post())) {
                $model_exp->resume_id = $model->id;
                $model_exp->year = (int) $model_exp->year;
                $model_exp->year_end_work = (int) $model_exp->year_end_work;


                $model_exp->until_now_work = $model_exp->until_now_work[0];
                if ($model_exp->until_now_work === '') {
                }
                if ($model_exp->save()) {
                    return $this->redirect(['myresume']);
                } else {
                    // VarDumper::dump($model_exp, 5, true);
                    // var_dump($model->getErrors());
                }
            } else {
                // var_dump($model->getErrors());
            }
            // }
        }

        return $this->render('createResume', [
            'model' => $model,
            'model_exp' => $model_exp,
        ]);
    }

    /**
     * Displays update page
     */
    public function actionEdit($id)
    {
        $session = Yii::$app->session;
        if ($session->has('user_id')) {
            $oneResume = ResumeForm::findOne($id);

            return $this->render('editResume', [
                'model' => $oneResume,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $oneResume = ResumeForm::findOne($id);
        if ($oneResume->load(Yii::$app->request->post())) {
            $oneResume->file = WebUploadedFile::getInstance($oneResume, 'file');

            if ($oneResume->validate('file')) {
                $oneResume->file->saveAs('images/' . $oneResume->file->name);
                $oneResume->image = Yii::getAlias('@web/images/') . $oneResume->file->name;
            }

            $oneResume->employment = $oneResume->employment[0];
            $oneResume->schedule = $oneResume->schedule[0];

            if ($oneResume->save()) {
                return $this->redirect(['myresume']);
            } else {
                // VarDumper::dump($oneResume, 5, true);
                // var_dump($oneResume->getErrors());
            }
        }
    }

    /**
     * Generates 100 test resumes in the database
     */
    public function actionGenerate()
    {
        $faker = Factory::create('ru_RU');
        $spec = [
            'Администратор', 
            'Программист', 
            'Контент-менеджер', 
            'Базы данных', 
            'Верстальщик'];
        $emp = [
            'Полная занятость', 
            'Частичная занятость', 
            'Проектная/Временная работа',
            'Волонтёрство', 
            'Стажировка'
        ];

        $shed = [
            'Полный день', 
            'Сменный график', 
            'Гибкий график',
            'Удалённая работа', 
            'Вахтовый метод'
        ];
        $m = [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        ];

        for ($i = 0; $i < 100; $i++) {
            $resume = new ResumeForm();
            $resume->image = $faker->file(Yii::getAlias('@app/web/images/'), Yii::getAlias('@app/web/images/faker-images/'), false);
            $resume->surname = (($faker->randomDigit % 2) == 0) ? $faker->firstName('male') : $faker->firstName('female');
            $resume->name = (($faker->randomDigit % 2) == 0) ? $faker->name('male') : $faker->name('female');
            $resume->patronymic = (($faker->randomDigit % 2) == 0) ? $faker->lastName('male') : $faker->lastName('female');
            $resume->birthday = $faker->date('d.m.Y', 'now');
            $resume->gender = (($faker->randomDigit % 2) == 0) ? 'Мужской' : 'Женский';
            $resume->city = $faker->city;
            $resume->email = $faker->freeEmail;
            $resume->phone = $faker->regexify('^\+[0-9]{1} [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}$');
            $resume->specialization = $spec[rand(0, 4)];
            $resume->desired_salary = rand(5000, 200000);
            $resume->employment = $emp[rand(0, 5)];
            $resume->schedule = $shed[rand(0, 5)];
            $resume->experience = (($faker->randomDigit % 2) == 0) ? 'Нет опыта работы' : 'Есть опыт работы';
            $resume->about = $faker->text(rand(1500, 2500));
            $resume->viewed = rand(10, 150);
            $resume->published_at = $faker->dateTime('now');
            $resume->updated_at = $faker->optional($weight = 0.5, $default = NULL)->dateTime('now');

            if($resume->save(false)){

                $exp = new ExperienceForm();
                $exp->month = $m[rand(0, 11)];
                $exp->year = $faker->date('Y', 2010);
                $exp->month_end_work = $m[rand(0, 11)];
                $exp->year_end_work = $faker->date('Y', 'now');
                $exp->until_now_work = (($faker->randomDigit % 2) == 0) ? NULL : 'По настоящее время';
                $exp->organization = $faker->word();
                $exp->exp_spec = $spec[rand(0, 4)];
                $exp->responsibility = $faker->text(rand(300, 500));
                $exp->resume_id = $resume->id;

                if($exp->save(false)){
                }
            }
        }
        return $this->redirect(['/']);
        // die('Data generation is complete!');
    }
}
