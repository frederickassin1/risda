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


    public function actionForgotPassword()
    {
        $this->layout = 'main-login';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset the password for the provided email address.');
            }
        }

        return $this->render('forgot-password', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {

        $this->layout = 'main-login';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new \yii\base\InvalidArgumentException('Invalid password reset token.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }

    public function actionTerma()
    {

        $response = [
            'title' => 'Terma dan Makluman',
            'content' => $this->renderPartial('terma'),
            'footer' => '<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fas fa-times-circle"></span>&nbsp;Tutup</button>',
        ];
        return json_encode($response);
    }

    public function actionContactUs()
    {
        return $this->render('contact-us', []);
    }

    public function actionPendaftaranAwal()
    {
        $user = Yii::$app->user->identity; // Getting user id
        $close = TblSetup::find()->where(['status' => 1])->one();
        $sukan = RefSukan::find()->where(['status' => 1, 'jenis' => 1])->all();
        $olahraga = RefSukan::find()->where(['status' => 1, 'jenis' => 2])->all();

        if ($postData = Yii::$app->request->post()) {
            // Collect IDs that need to be preserved
            $preserveIds = [];
            foreach ($postData['TblPenyertaan']['id'] as $k => $v) {
                if ($v != 0) {
                    $preserveIds[] = $k;
                    $model = TblPenyertaan::findOne(['created_by' => $user->id, 'kategori_id' => $k]);
                    if (!$model) {
                        $model = new TblPenyertaan();
                    }
                    $model->kategori_id = $k;
                    $model->ipta_id = $user->ipta_id;
                    $model->total = $v;
                    $model->created_by = $user->id;
                    $model->save();
                }
            }
            // Delete records not present in $preserveIds
            TblPenyertaan::deleteAll(['AND', ['created_by' => $user->id], ['NOT IN', 'kategori_id', $preserveIds]]);
            return $this->redirect(['pendaftaran-awal']);
        }

        return $this->render('pendaftaran-awal', [
            'list' => $sukan,
            'list2' => $olahraga,
            'bil' => 1,
            'bil2' => 1,
        ]);
    }

    public function actionPendaftaranList()
    {
        $searchModel = new TblPenyertaanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model= TblPenyertaan::find()->where(['created_by' => Yii::$app->user->identity->id])->andWhere(['!=','status' ,'ENTRY'])->one();
        return $this->render('pendaftaran-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }
    public function actionSubmitPendaftaran()
    {
        $model = TblPenyertaan::findAll(['created_by' => Yii::$app->user->identity->id]);
        if($model){
            foreach($model as $a){
                $a->status = 'VERIFIED';
                $a->save(false);
            }
        }
        return $this->redirect(['pendaftaran-list']);
    }

    public function actionPendaftaranPenginapan()
    {
        $users = Yii::$app->user->identity;

        $model = TblPenginapan::findOne(['ipta_id' => $users->ipta_id]);

        if (!$model) {
            $model = new TblPenginapan();
        }

        if ($this->request->isPost && $model->load($this->request->post())) {

            if ($model->isNewRecord) {
                $model->create_dt = date('Y-m-d H:i:s');
                $model->create_by = $users->id;
            }

            $model->ipta_id = $users->ipta_id;

            $model->update_dt = date('Y-m-d H:i:s');
            $model->update_by = $users->id;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Maklumat telah berjaya dikemaskini');
                return $this->redirect(['pendaftaran-penginapan']);
            }
        }

        return $this->render('pendaftaran-penginapan', [
            'model' => $model,
        ]);
    }
    public function actionAddAthlete($id){
        
    }

    
}
