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
use app\models\sukum\ListSukan;
use app\models\sukum\TblPendaftaran;
use app\models\sukum\TblSukan;
use app\models\TblPemain;
use app\models\TblPenginapan;
use app\models\TblPenyertaan;
use app\models\TblPenyertaanSearch;
use app\models\TblSetup;
use app\models\TblUsers;
use app\models\TblPeserta;
use app\models\TblPesertaSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use app\models\sukum\VwInvois;
use app\models\RefIpta;

class KontijenController extends Controller
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


    /**
     * Logout action.
     *
     * @return Response
     */


    // pendaftaran awal permainan
    public function actionPendaftaranAwal()
    {
        $user = Yii::$app->user->identity; // Getting user id
        //  $ipta = $user->ipta_id;
        $close = TblSetup::find()->where(['status' => 1])->one();
        $nama = RefSukan::find()->where(['status' => 1])->all();

        $sukan = TblSukan::find()->where(['status' => 1])->all();
        $olahraga = TblSukan::find()->where(['status' => 2, 'jenis' => 2])->all();
        $penyertaan = TblPendaftaran::find()->where(['created_by' => $user])->one() ?
            TblPendaftaran::find()->where(['created_by' => $user->id])->one() :
            new TblPendaftaran();
        $checkApplication = TblPendaftaran::find()->where(['status' => "1", 'created_by' => $user->id]);

        if ($checkApplication->exists()) {
            if ($penyertaan->status == 1) {
                Yii::$app->session->setFlash('Info', ['title' => 'Pendaftaran Permainan telah dihantar']);


                return $this->redirect(['senarai-pendaftaran']);
            } else {
                Yii::$app->session->setFlash('Info', ['title' => 'Anda belum membuat sebarang pendaftaran']);
                return $this->redirect(['pendaftaran-awal']);
            }
        }
        if (Yii::$app->request->post('simpan')) {


            if ($postData = Yii::$app->request->post()) {
                // Collect IDs that need to be preserved
                $preserveIds = [];
                foreach ($postData['ListSukan']['id'] as $k => $v) {
                    if ($v != 0) {
                        $preserveIds[] = $k;
                        $model = ListSukan::findOne(['created_by' => $user->id, 'sukanID' => $k]);
                        if (!$model) {
                            $model = new ListSukan();
                        }
                        $model->sukanID = $k;
                        $model->total = $v;
                        $model->created_by = $user->id;

                        $penyertaan->created_by = $user->id;
                        $penyertaan->created_dt =  date('Y-m-d H:i:s');
                        $penyertaan->ipta_id = $user->ipta_id;

                        $penyertaan->save(false);
                        $model->pendaftaranID = $penyertaan->id;
                        $model->save(false);
                    }
                    Yii::$app->session->setFlash('Info', ['title' => 'Pendaftaran Berjaya Disimpan']);
                }
                // Delete records not present in $preserveIds
                // ListSukan::deleteAll(['AND', ['created_by' => $user->id], ['NOT IN', 'sukanID', $preserveIds]]);
                return $this->redirect(['pendaftaran-awal-olahraga']);
            }
        } elseif (Yii::$app->request->post('hantar')) {
            if ($postData = Yii::$app->request->post()) {
                // Collect IDs that need to be preserved
                $preserveIds = [];
                foreach ($postData['ListSukan']['id'] as $k => $v) {
                    if ($v != 0) {
                        $preserveIds[] = $k;
                        $model = ListSukan::findOne(['created_by' => $user->id, 'sukanID' => $k]);
                        if (!$model) {
                            $model = new ListSukan();
                        }
                        $model->sukanID = $k;
                        // $model->ipta_id = $user->ipta_id;
                        $model->total = $v;
                        $model->created_by = $user->id;

                        $penyertaan->created_by = $user->id;
                        $penyertaan->created_dt =  date('Y-m-d H:i:s');
                        $penyertaan->status = 1;
                        $penyertaan->save(false);
                        $model->pendaftaranID = $penyertaan->id;
                        $model->save(false);
                    }
                    Yii::$app->session->setFlash('Info', ['title' => 'Pendaftaran Berjaya Dihantar']);
                }
                // Delete records not present in $preserveIds
                // ListSukan::deleteAll(['AND', ['created_by' => $user->id], ['NOT IN', 'sukanID', $preserveIds]]);
                return $this->redirect(['senarai-pendaftaran']);
            }
        }


        return $this->render('pendaftaran-awal', [
            'list' => $sukan,
            'list2' => $olahraga,
            'bil' => 1,
            'bil2' => 1, 'nama' => $nama
        ]);
    }

    public function actionPendaftaranAwalOlahraga()
    {
        $user = Yii::$app->user->identity; // Getting user id
        
        //  $ipta = $user->ipta_id;
        $close = TblSetup::find()->where(['status' => 1])->one();
        $nama = RefSukan::find()->where(['status' => 1])->all();

        $sukan = TblSukan::find()->where(['status' => 1])->all();
        $olahraga = TblSukan::find()->where(['status' => 2, 'jenis' => 2])->all();
        $penyertaan = TblPendaftaran::find()->where(['created_by' => $user])->one() ?
            TblPendaftaran::find()->where(['created_by' => $user->id])->one() :
            new TblPendaftaran();
        $checkApplication = TblPendaftaran::find()->where(['status' => "1", 'created_by' => $user->id]);

        if ($checkApplication->exists()) {
            if ($penyertaan->status == 1) {
                Yii::$app->session->setFlash('Info', ['title' => 'Pendaftaran Permainan telah dihantar']);


                return $this->redirect(['senarai-pendaftaran']);
            } else {
                Yii::$app->session->setFlash('Info', ['title' => 'Anda belum membuat sebarang pendaftaran']);
                return $this->redirect(['pendaftaran-awal-olahraga']);
            }
        }
        
        if (Yii::$app->request->post('simpan')) {


            if ($postData = Yii::$app->request->post()) {
                // Collect IDs that need to be preserved
                $preserveIds = [];
                foreach ($postData['ListSukan']['id'] as $k => $v) {
                    if ($v != 0) {
                        $preserveIds[] = $k;
                        $model = ListSukan::findOne(['created_by' => $user->id, 'sukanID' => $k]);
                        if (!$model) {
                            $model = new ListSukan();
                        }
                        // $model->scenario = "max";

                        if (Yii::$app->request->isAjax && $model->load($_POST)) {
                            Yii::$app->response->format = 'json';
                            return \yii\widgets\ActiveForm::validate($model);
                        }
                
                
                        $model->sukanID = $k;
                        $model->total = $v;
                        $model->created_by = $user->id;

                        $penyertaan->created_by = $user->id;
                        $penyertaan->created_dt =  date('Y-m-d H:i:s');
                        $penyertaan->ipta_id = $user->ipta_id;

                        $penyertaan->save(false);
                        $model->pendaftaranID = $penyertaan->id;
                        $model->save(false);
                    }
                    Yii::$app->session->setFlash('Info', ['title' => 'Pendaftaran Berjaya Disimpan']);
                }
                // Delete records not present in $preserveIds
                // ListSukan::deleteAll(['AND', ['created_by' => $user->id], ['NOT IN', 'sukanID', $preserveIds]]);
                return $this->redirect(['pendaftaran-awal-olahraga']);
            }
        } elseif (Yii::$app->request->post('hantar')) {
            if ($postData = Yii::$app->request->post()) {
                // Collect IDs that need to be preserved
                $preserveIds = [];
                foreach ($postData['ListSukan']['id'] as $k => $v) {
                    if ($v != 0) {
                        $preserveIds[] = $k;
                        $model = ListSukan::findOne(['created_by' => $user->id, 'sukanID' => $k]);

                        if (!$model) {
                            $model = new ListSukan();
                        }
                        $model->scenario = "max";

                        if (Yii::$app->request->isAjax && $model->load($_POST)) {
                            Yii::$app->response->format = 'json';
                            return \yii\widgets\ActiveForm::validate($model);
                        }
                
                
                        $model->sukanID = $k;
                        // $model->ipta_id = $user->ipta_id;
                        $model->total = $v;
                        $model->created_by = $user->id;

                        $penyertaan->created_by = $user->id;
                        $penyertaan->created_dt =  date('Y-m-d H:i:s');
                        $penyertaan->status = 1;
                        $penyertaan->save(false);
                        $model->pendaftaranID = $penyertaan->id;
                        $model->save(false);
                    }
                    Yii::$app->session->setFlash('Info', ['title' => 'Pendaftaran Berjaya Dihantar']);
                }
                // Delete records not present in $preserveIds
                // ListSukan::deleteAll(['AND', ['created_by' => $user->id], ['NOT IN', 'sukanID', $preserveIds]]);
                return $this->redirect(['senarai-pendaftaran']);
            }
        }


        return $this->render('pendaftaran-awal-olahraga', [
            'list' => $sukan,
            'list2' => $olahraga,
            'bil' => 1,
            'bil2' => 1, 'nama' => $nama
        ]);
    }

    public function actionSenaraiPendaftaran()
    {
        //filter grid
        //get user ID
        $biodata = TblUsers::find()->where(['id' => Yii::$app->user->identity->id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => TblPendaftaran::find()->where(['created_by' => $biodata->id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('/kontijen/senarai-pendaftaran', [
            'dataProvider' => $dataProvider,
            'biodata' => $biodata
        ]);
    }

    public function actionViewBorangPendaftaran($id)
    {

        $daftar = TblPendaftaran::find()->where(['id' => $id])->one();

        $dataProvider = new ActiveDataProvider([
            'query' => ListSukan::find()->andFilterWhere(['pendaftaranID' => $id])->orderBy(['sukanID' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        // $sum = $dataProvider->sum('total');

        return $this->render('/kontijen/view-borang-pendaftaran', [
            'id' => $id, 'daftar' => $daftar, 'dataProvider' => $dataProvider,
        ]);
    }
    // BORANG G1
    public function actionBorangPengesahanAwalPenyertaan($id)
    {

        $model = TblPendaftaran::find()->where(['id' => $id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => ListSukan::find()->andFilterWhere(['pendaftaranID' => $id])->orderBy(['sukanID' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('/kontijen/borang-g', [
            'id' => $id, 'model' => $model, 'dataProvider' => $dataProvider
        ]);
    }

    // BORANG Q1

    public function actionBorangPendaftaranKuantitatif($id)
    {

        $model = TblPendaftaran::find()->where(['id' => $id])->one();

        $jaring = RefSukan::find()->where(['id' => 2])->one();
        $tampar = RefSukan::find()->where(['id' => 4])->one();

        // $dataProvider = new ActiveDataProvider([
        //     'query' => RefSukan::find()->andFilterWhere(['id' => 2])->orderBy(['id' => SORT_ASC]),
        //     'pagination' => [
        //         'pageSize' => 20,
        //     ],
        // ]);
        return $this->render('/kontijen/borang-q1', [
            'id' => $id, 'model' => $model, 'jaring' => $jaring,
            'tampar' => $tampar
        ]);
    }
    // PROFIL KONTIJEN
    public function actionProfilKontijen($id)
    {
        $user = Yii::$app->user->identity; // Getting user id

        $model = TblUsers::find()->where(['id' => $id])->one();
        $pemain = new TblPemain();

        if (($model->load(Yii::$app->request->post()))) {


            $model->save(false);
            $pemain->save(false);

            Yii::$app->session->setFlash('PROFIL', ['title' => 'Berjaya Kemaskini']);
            return $this->redirect(['profil-kontijen?id=' . $id]);
        }
        return $this->render('/kontijen/profil-kontijen', [
            'id' => $id, 'model' => $model
        ]);
    }

    public function actionPendaftaranList()
    {
        $searchModel = new TblPenyertaanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $model = TblPenyertaan::find()->where(['created_by' => Yii::$app->user->identity->id])->andWhere(['!=', 'status', 'ENTRY'])->one();
        return $this->render('pendaftaran-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionSubmitPendaftaran()
    {
        $model = TblPenyertaan::findAll(['created_by' => Yii::$app->user->identity->id]);
        if ($model) {
            foreach ($model as $a) {
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
    public function actionAddAthlete($id)
    {
    }

    //borang pendaftaran peserta
    public function actionIndexPeserta()
    {
        $kid = Yii::$app->user->identity->ipta_id;
        $model = TblPendaftaran::find()->where(['id' => $kid])->one();

        $searchModel = new TblPesertaSearch();
        $dataProvider = $searchModel->searchByIPTA($this->request->queryParams);

        return $this->render('pendaftaranPeserta/indexpeserta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'model' => $model
        ]);
    }

    public function actionView($id)
    {
        return $this->render('pendaftaranPeserta/view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new TblPeserta();
        $model->id_kontinjen = Yii::$app->user->identity->ipta_id;
        $model->date_created = date('Y/m/d H:i:s');
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('pendaftaranPeserta/create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('pendaftaranPeserta/update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index-peserta']);
    }

    //daftar pemain//

    public function actionDaftarPemain()
    {
        $kid = Yii::$app->user->identity->ipta_id;
        $model = TblPendaftaran::find()->where(['id' => $kid])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => ListSukan::find()->andFilterWhere(['pendaftaranID' => $model->id])->orderBy(['sukanID' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('daftarPemain/view-pendaftaran', [
            'model' => $model, 'dataProvider' => $dataProvider
        ]);
    }
    public function actionDaftarPermainanPemain($id)
    {
        $peserta = TblPeserta::find()->where(['id' => $id])->one();
        $sukan = ListSukan::find()->where(['pendaftaranID' => $peserta->id_kontinjen])->one();
        $model = new TblPemain();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = '1';
            $model->listsukan_id = $id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', ['title' => 'Pemain berjaya didaftarkan']);
            } else {
                if ($model->errors['icno'])
                    VarDumper::dump($model->errors, $depth = 10, $highlight = true);
                die;
            }
        }
        // $main = TblPemain::find()->where(['icno'=>$peserta->nokp])->one();

        $pemain = new ActiveDataProvider([
            'query' => TblPemain::find()
                ->where(['icno' => $peserta->nokp]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
      

        return $this->render('daftarPemain/senarai-permainan-pemain', [
            'model' => $model, 'sukan' => $sukan, 'pemain' => $pemain, 'id' => $id
        ]);

        // return $this->redirect(['index-peserta']);

    }
    public function actionMaklumatPermainan($id)
    {
        $sukan = TblSukan::find()->where(['id' => $id])->one();
        $pemain = new ActiveDataProvider([
            'query' => TblSukan::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('daftarPemain/maklumat-permainan', [
            'sukan' => $sukan,
            'pemain' => $pemain,
        ]);
    }
    public function actionSenaraiPemain($id)
    {
        $sukan = ListSukan::find()->where(['id' => $id])->one();
        $pemain = new ArrayDataProvider([
            'allModels' => $sukan->pemain,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('daftarPemain/senarai_pemain', [
            'sukan' => $sukan,
            'pemain' => $pemain,
        ]);
    }

    public function actionTambahPemain($id)
    {
        $model = new TblPemain();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = '1';
            $model->listsukan_id = $id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', ['title' => 'Pemain berjaya didaftarkan']);
            } else {
                if ($model->errors['icno'])
                    VarDumper::dump($model->errors, $depth = 10, $highlight = true);
                die;
            }
        }



        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('daftarPemain/_tambah_pemain', [
                'model' => $model,
            ]);
        }
        return $this->redirect(['senarai-pemain', 'id' => $id]);
    }

    public function actionTambahPermainan($id)
    {
        $peserta = TblPeserta::find()->where(['id' => $id])->one();
        $sukan = ListSukan::find()->where(['pendaftaranID' => $peserta->id_kontinjen])->one();
        $model = new TblPemain();
        // var_dump($sukan->pendaftaranID);die;
        if ($model->load(Yii::$app->request->post())) {
            $model->status = '1';
            // $model->listsukan_id = $sukan->sukanID;
            $model->icno = $peserta->nokp;
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', ['title' => 'Pemain berjaya didaftarkan']);
                return $this->redirect(['daftar-permainan-pemain', 'id' => $peserta->id]);
            } else {
                if ($model->errors['icno'])
                    VarDumper::dump($model->errors, $depth = 10, $highlight = true);
                die;
            }
        }
        // $main = TblPemain::find()->where(['icno'=>$peserta->nokp])->one();

        $pemain = new ActiveDataProvider([
            'query' => ListSukan::find()->joinWith('pemain')
                ->where(['icno' => $peserta->nokp]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('daftarPemain/_tambah_permainan', [
                'model' => $model, 'sukan' => $sukan, 'pemain' => $pemain
            ]);
        }

        // return $this->redirect(['index-peserta']);

    }


    public function actionInvoisKontinjen($id)
    {
        // $kontinjen = TblPendaftaran::find()->where(['id' => $id])->one();
        $invois = VwInvois::find()->where(['id' => $id]);
        $model = new ActiveDataProvider([
            'query' => $invois,

        ]);
        // var_dump($model);die;
        $ipta = RefIpta::find()->where(['id' => $id])->one();


        return $this->render('invois-kontinjen', [
            'model' => $model,
            'ipta' => $ipta,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = TblPeserta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
