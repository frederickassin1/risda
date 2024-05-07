<?php

namespace app\controllers;


use app\models\TblDemografi;
use app\models\TblKecerdasanEmosi;
use app\models\TblPersonaliti;
use app\models\TblResults;
use app\models\TblUsers;
use app\models\TblUsersSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\ForbiddenHttpException;
use app\models\AverageCalculator;
use app\models\RefIpta;
use app\models\RefKategori;
use app\models\RefYuran;
use app\models\sukum\ListSukan;
use app\models\sukum\RefSukan;
use app\models\TblSetup;
use app\models\TblSetupSearch;
use app\models\sukum\TblPendaftaran;
use app\models\sukum\TblPendaftaranSearch;
use app\models\sukum\TblSukan;
use app\models\sukum\TblSukanSearch;
use app\models\TblPenyertaan;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;

/**
 * DemografiController implements the CRUD actions for TblDemografi model.
 */
class AdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'], // Logged in users
                            'matchCallback' => function ($rule, $action) {
                                $user = Yii::$app->user->identity;
                                return $user && $user->type == 1; // Ensure the user is an admin
                            }
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        throw new ForbiddenHttpException('You do not have permission to access this page.');
                    },
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'reset-penilaian' => ['POST'],
                        // 'subjawatans' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function actionUserList()
    {
        $searchModel = new TblUsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('user-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSetup()
    {
        $id = Yii::$app->user->identity->id;

        $model = new TblSetup();

        if ($model->load(Yii::$app->request->post())) {
            // $model->update_dt = date("y-m-d H:i:s");
            $model->created_by = $id;

            if ($model->save()) {

                Yii::$app->session->setFlash('success', 'Berjaya di tambah.');
                return $this->redirect(['admin/setup-index']);
            }
        }

        return $this->render('setup', [
            'model' => $model,
        ]);
    }
    public function actionYuran($id)
    {
        $user = Yii::$app->user->identity; //getting user id
        // $user = TblUsers::findOne(['id' => $id]);
        // $open = TblSetup::find()->where(['status' => 1])->andWhere()->one();
        $model = new RefYuran(); // load the current user
        $sukan = RefKategori::find()->where(['status' => 1, 'sukan_id' => $id])->all();

        if ($pilih = Yii::$app->request->post()) {
            foreach ($pilih['RefYuran']['id'] as $k => $v) {
                // if ($v != 0) {

                $model = RefYuran::findOne(['kategori_id' => $k]);

                if (!$model) {
                    $model = new RefYuran();
                }
                $model->jenis_id = 2;
                $model->kategori_id = $k;
                // $model->nama = $user->ipta_id;
                $model->total = $v;
                $model->created_by = $user->id;
                if ($model->save()) {
                }
                // }
            }
            //--------Model Notification-----------//
            // Yii::$app->session->setFlash('alert', ['title' => 'Berjaya', 'type' => 'success', 'msg' => 'Pengesahan telah dihantar!']);
            return $this->redirect(['refkategori/index']);
        }

        return $this->render('yuran', [
            'model' => $model,
            'list' => $sukan,
            // 'list2' => $olahraga,
            'bil' => 1,
            'bil2' => 1,
            // 'checkopen' => $checkopen
        ]);
    }

    public function actionSetupIndex()
    {

        $searchModel = new TblSetupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('setup-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSenaraiPendaftaran()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblPendaftaran::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('senarai-pendaftaran', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPengesahanPendaftaran($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => ListSukan::find()->andFilterWhere(['pendaftaranID' => $id])->orderBy(['sukanID' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Pendaftaran berjaya disimpan!');
            return $this->redirect(['admin/senarai-pendaftaran']);
        }

        return $this->render('pengesahan-pendaftaran', [
            'model' => $model, 'dataProvider' => $dataProvider
        ]);
    }

    public function actionDeletePendaftaran($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['senarai-pendaftaran']);
    }

    public function actionInvois($ipta_id)
    {
        $id = TblPendaftaran::findOne(['ipta_id' => $ipta_id]);
        $invois = ListSukan::find()
            ->joinWith('sukan')
            ->where(['pendaftaranID' => $ipta_id])
            ->orderby(['tbl_sukan.jenis' => SORT_DESC , 'sukanID'=>SORT_ASC]);
        $model = new ActiveDataProvider([
            'query' => $invois,

        ]);
        $ipta = RefIpta::find()->where(['id' => $id])->one();
        return $this->render('invois', [
            'model' => $model,
            'ipta' => $ipta,
        ]);
    }

    public function actionSenaraiSukan(){
        $searchModel = new TblSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    //findModel TblPendaftaran
    protected function findModel($id)
    {
        if (($model = TblPendaftaran::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //update // view // create
    public function actionUpdate($id)
    {
        $admin=Yii::$app->user->getId();
        $model = TblSukan::findOne($id);
// var_dump($id);die;
       if ($model->load(Yii::$app->request->post())) {
            
            $model->update_by = $admin;
            $model->update_dt = date('Y-m-d H:i:s');
                        
            $model->save(false);  
                        
            return $this->redirect(['senarai-sukan']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}
