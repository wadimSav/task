<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ResumeForm;
use app\models\ExperienceForm;
use yii\web\UploadedFile as WebUploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays myresume page.
     *
     * @return string
     */
    public function actionMyresume()
    {
        return $this->render('myresume');
    }

    /**
     * Displays create resume form page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new ResumeForm();
        $model_exp = new ExperienceForm();

        if($model->load(Yii::$app->request->post()) && $model_exp->load(Yii::$app->request->post())) {
            $model->image = WebUploadedFile::getInstance($model, 'image');
            if($model->upload()) {
                var_dump('file is uploaded successfully');
            }
        }

        return $this->render('createResume', [
            'model' => $model,
            'model_exp' => $model_exp,
        ]);
    }

    /**
     * Displays experience block via ajax.
     *
     * @return string
     */
    public function actionExperience()
    {
        $model = new ExperienceForm();
        if(\Yii::$app->request->isAjax){
            return $this->renderAjax('experience', [
                'model' => $model,
            ]);
        }
        // return $this->render('createResume', [
        //     'model' => $model,
        // ]);
    }
}
