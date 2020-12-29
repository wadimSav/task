<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ResumeForm;
use app\models\ExperienceForm;
use app\models\ResumeSearch;
use Faker\Factory;
use yii\helpers\VarDumper;
use yii\web\UploadedFile as WebUploadedFile;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * Pass the filtering model and data provider for the homepage
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $listResume = $searchModel->search(Yii::$app->request->get());
        return $this->render('index', [
            'listResume' => $listResume,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Delete resume and related entries.
     * 
     * @param int $id resume id
     */
    public function actionDelete($id)
    {
        $resume = ResumeForm::findOne($id);
        $resume->delete();

        return $this->redirect(['myresume']);
    }

    /**
     * Displays detail resume page.
     * 
     * @param int $id resume id
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
            $model->image = $model->file->name;
            $model->birthday = Yii::$app->formatter->asDatetime($model->birthday, 'php:Y-m-d H:i:s');
            $model->employment = implode('' ,$model->employment);
            $model->schedule = implode('' ,$model->schedule);
            
            if ($model->save() && $model_exp->load(Yii::$app->request->post())) {
                $model->upload();
                $model_exp->resume_id = $model->id;
                $model_exp->year = (int) $model_exp->year;
                $model_exp->year_end_work = (int) $model_exp->year_end_work;

                if ($model_exp->save()) {
                    return $this->redirect(['myresume']);
                }
            }
        }

        return $this->render('createResume', [
            'model' => $model,
            'model_exp' => $model_exp,
            ]);
        }

    /**
     * Displays update page
     * 
     * @param int $id resume id
     */
    public function actionEdit($id)
    {
        $oneResume = ResumeForm::findOne($id);

        return $this->render('editResume', [
            'model' => $oneResume,
        ]);
    }

    /**
     * Updates resume data
     * 
     * @param int $id resume id
     */
    public function actionUpdate($id)
    {
        $oneResume = ResumeForm::findOne($id);
        if ($oneResume->load(Yii::$app->request->post())) {
            $oneResume->file = WebUploadedFile::getInstance($oneResume, 'file');
            $oneResume->image = $oneResume->file->name;
            $oneResume->birthday = Yii::$app->formatter->asDatetime($oneResume->birthday, 'php:Y-m-d H:i:s');
            $oneResume->employment = implode('' ,$oneResume->employment);
            $oneResume->schedule = implode('' ,$oneResume->schedule);
            if ($oneResume->save()) {
                $oneResume->upload();
                Yii::$app->session->setFlash('success', 'Резюме изменено успешно!');
                return $this->redirect(['myresume']);
            }
        }
    }

    /**
     * Generates 100 test resumes in the database
     * 
     */
    public function actionGenerate()
    {
        $faker = Factory::create('ru_RU');

        for ($i = 0; $i < 20; $i++) {
            $resume = new ResumeForm();
            $resume->image = $faker->file(Yii::getAlias('@app/web/images/'), Yii::getAlias('@app/web/images/faker-images/'), false);
            $resume->surname = (($faker->randomDigit % 2) == 0) ? $faker->lastName('male') : $faker->lastName('female');
            $resume->name = (($faker->randomDigit % 2) == 0) ? $faker->firstName('male') : $faker->firstName('female');
            $resume->patronymic = (($faker->randomDigit % 2) == 0) ? $faker->middleName('male') : $faker->middleName('female');
            $resume->birthday = Yii::$app->formatter->asDatetime($faker->dateTime('now'), 'php:Y-m-d H:i:s');
            $resume->gender = (($faker->randomDigit % 2) == 0) ? 1 : 2;
            $resume->city = rand(1, 7);
            $resume->email = $faker->freeEmail;
            $resume->phone = $faker->regexify('^\+[0-9]{1} [0-9]{3} [0-9]{3}-[0-9]{2}-[0-9]{2}$');
            $resume->specialization = rand(1, 26);
            $resume->desired_salary = rand(5000, 200000);
            $resume->employment = rand(1, 5);
            $resume->schedule = rand(1, 5);
            $resume->experience = (($faker->randomDigit % 2) == 0) ? 0 : 1;
            $resume->about = $faker->text(rand(1500, 2500));
            $resume->viewed = rand(10, 150);
            $resume->published_at = $faker->dateTime('now');
            $resume->updated_at = $faker->dateTime('now');

            if($resume->save(false)){
                if($resume->experience == 1){
                    $exp = new ExperienceForm();
                    $exp->month = rand(0, 11);
                    $exp->year = $faker->date('Y', 2010);
                    $exp->month_end_work = rand(0, 11);
                    $exp->year_end_work = $faker->date('Y', 'now');
                    $exp->until_now_work = (($faker->randomDigit % 2) == 0) ? false : true;
                    $exp->organization = $faker->word();
                    $exp->exp_spec = rand(1, 26);
                    $exp->responsibility = $faker->text(rand(300, 500));
                    $exp->resume_id = $resume->id;

                    if($exp->save(false)){
                    }
                }
            }
        }
        return $this->redirect(['/']);
        // die('Data generation is complete!');
    }
}
