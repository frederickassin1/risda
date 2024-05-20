<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\pml\RefAkses;
use app\models\ResetPasswordForm;
use app\models\Ref_Kategori;
use app\models\RefSukan;
use app\models\TblPenginapan;
use app\models\TblPenyertaan;
use app\models\TblPenyertaanSearch;
use app\models\TblSetup;
use InvalidArgumentException;
use yii\helpers\VarDumper;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'error', 'register', 'activate', 'forgot-password', 'reset-password', 'terma'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],

            ],
            'verbs' => [
                'class' => VerbFilter::class,
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

        $id = Yii::$app->user->identity->id;

        return $this->render('index', []);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Selamat Datang!');
            return $this->redirect(['index']);
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




    public function actionContactUs()
    {
        return $this->render('contact-us', []);
    }

    
    public function actionAddAthlete($id){
        
    }

    
}
