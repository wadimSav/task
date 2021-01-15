<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ResumeForm;
use app\models\ExperienceForm;
use app\models\ResumeSearch;
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
            // получаем имя файла из аттрибута модели
            $model->file = WebUploadedFile::getInstance($model, 'file');
            if(is_object($model->file)){
                $fileName = $model->file->baseName . '.' . $model->file->extension;
                $model->file->saveAs('images/faker-images/' . $fileName );
                $model->image = $fileName;
            }
            $model->birthday = Yii::$app->formatter->asDatetime($model->birthday, 'php:Y-m-d H:i:s');
            if(is_array($model->employment)){
                $model->employment = implode('' ,$model->employment);
            }
            if(is_array($model->schedule)){
                $model->schedule = implode('' ,$model->schedule);
            }
            
            if ($model->save(false) && $model_exp->load(Yii::$app->request->post())) {
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
            // получаем имя файла из аттрибута модели
            $oneResume->file = WebUploadedFile::getInstance($oneResume, 'file');
            if(is_object($oneResume->file)){
                $fileName = $oneResume->file->baseName . '.' . $oneResume->file->extension;
                $oneResume->file->saveAs('images/faker-images/' . $fileName );
                $oneResume->image = $fileName;
            }
            $oneResume->birthday = Yii::$app->formatter->asDatetime($oneResume->birthday, 'php:Y-m-d H:i:s');
            if(is_array($oneResume->employment)){
                $oneResume->employment = implode('' ,$oneResume->employment);
            }
            if(is_array($oneResume->schedule)){
                $oneResume->schedule = implode('' ,$oneResume->schedule);
            }
            if ($oneResume->save()) {
                Yii::$app->session->setFlash('success', 'Резюме изменено успешно!');
                return $this->redirect(['myresume']);
            }
        }
        
        return $this->render('editResume', [
            'model' => $oneResume,
        ]);
    }
}
