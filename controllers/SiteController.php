<?php

namespace app\controllers;

use app\models\enums\Specialist;
use Yii;
use yii\web\Controller;
use app\models\ResumeForm;
use app\models\ExperienceForm;
use app\models\ResumeSearch;
use app\models\SearchForm;
use yii\web\UploadedFile as WebUploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class SiteController extends Controller
{

    public function beforeAction($action)
    {
        $search = new SearchForm();

        if($search->load(Yii::$app->request->post()) && $search->validate())
        {
            $q = Html::encode($search->q);
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/search', 'q' => $q]));
        }
        return true;
    }
    
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
     * Осуществляет поиск по названию профессии 'resume.specialization' и в тексте колонки о себе 'resume.about'
     * 
     * @var string $q  параметр из запроса
     * @var array $specIdList  пустой массив
     * @var string $specValueList  пустая строка
     * @var string $pattern  regExp по которой ищем
     * @var array $specializationData  перечисление Specialist::listData()
     */
    public function actionSearch()
    {
        $q = Yii::$app->getRequest()->getQueryParam('q');
        $specIdList = []; 
        $specValueList = ''; 
        $pattern = "/$q/iu";

        $specializationData = Specialist::listData();
        
        foreach ($specializationData as $key => $value) {
            if (preg_match($pattern, $value) === 0) {
            } else {
                array_push($specIdList, $key);
                $specValueList .= $value;
            }
        }
        
        $query = ResumeForm::find()->andFilterWhere([
                'in', 'specialization', 
                array_unique($specIdList, SORT_NUMERIC)
                ])->orFilterWhere(['like', 'about', $q]);

        $resultSearch = $query->all();

        return $this->render('search', [
            'resultSearch' => $resultSearch,
            'q' => $q
        ]);
    }

}
