<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use Mpdf\Mpdf;

use app\models\TblInoutBaja;
use app\models\TblJumBaja;
use app\models\TblRecordsAdmin;
use InvalidArgumentException;
use kartik\mpdf\Pdf;
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

        $id = Yii::$app->user->identity;
        // VarDumper::dump($id->password);die;
        Yii::$app->passwordPolicy->checkDefaultPassword($id->password);

        // var_dump( $done->sum('rp'));die;
        // $admin_r1 = TblRecordsAdmin::find()->where(['YEAR(tarikh_sps)' => date('Y')])->sum('r1');
        // $admin_r4 = TblRecordsAdmin::find()->where(['YEAR(tarikh_sps)' => date('Y')])->sum('r4');
        // $fleet_rp = TblRecordsAdmin::find()->where(['YEAR(tarikh_sps)' => date('Y')])->sum('fleet_rp');
        return $this->render('index', [
            // 'model' => $model,
            // 'rp' => $admin_rp->sum('rp'),
            // 'r1' => $admin_rp->sum('r1'),
            // 'r4' => $admin_rp->sum('r4'),
            // 'f_rp' => $done->sum('rp'),
            // 'f_r1' => $done->sum('r1'),
            // 'f_r4' => $done->sum('r4'),
            // 't_rp' => $transit->sum('rp'),
            // 't_r1' => $transit->sum('r1'),
            // 't_r4' => $transit->sum('r4'),
            // 'in_stor' => $in_stor
        ]);
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

}
