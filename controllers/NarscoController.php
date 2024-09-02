<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\ForbiddenHttpException;
use app\models\AverageCalculator;
use app\models\TblBajaKeluarMasuk;
use app\models\TblBajaKeluarMasukSearch;
use app\models\TblInoutBaja;
use app\models\TblInOutBajaSearch;
use app\models\TblNarsco;
use app\models\TblNarscoSearch;
use app\models\TblRecordsAdmin;
use app\models\TblRecordsAdminSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use kartik\mpdf\Pdf;
use yii\web\Response;

/**
 * DemografiController implements the CRUD actions for TblDemografi model.
 */
class NarscoController extends Controller
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
                                return $user && ($user->type == 1 || $user->type == 3); // Ensure the user is an admin
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



    public function actionRecordList()
    {
        $searchModel = new TblNarscoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $searchModel2 = new TblBajaKeluarMasukSearch();
        $dataProvider2 = $searchModel2->search($this->request->queryParams);

        return $this->render('record-list', [
            'searchModel' => $searchModel,
            'model' => $dataProvider,
            'searchModel2' => $searchModel2,
            'model2' => $dataProvider2,

        ]);
    }

    public function actionRecordInOut()
    {
        $searchModel = new TblNarscoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $searchModel2 = new TblBajaKeluarMasukSearch();
        $dataProvider2 = $searchModel2->search($this->request->queryParams);

        return $this->render('record_inout', [
            'searchModel' => $searchModel,
            'model' => $dataProvider,
            'searchModel2' => $searchModel2,
            'model2' => $dataProvider2,

        ]);
    }
    public function actionRecordOut()
    {
        $searchModel = new TblNarscoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $searchModel2 = new TblBajaKeluarMasukSearch();
        $dataProvider2 = $searchModel2->search($this->request->queryParams);

        return $this->render('record_out', [
            'searchModel' => $searchModel,
            'model' => $dataProvider,
            'searchModel2' => $searchModel2,
            'model2' => $dataProvider2,

        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // $model->scenario = 'update';

        $user_id = Yii::$app->user->identity->id;

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->update_dt = date('Y-m-d H:i:s');
            $model->update_by = $user_id;

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Rekod telah berjaya dikemaskini');
                return $this->redirect(['record-list', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,

        ]);
    }
    protected function findModel($id)
    {
        if (($model = TblRecordsAdmin::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // //add new records
    public function actionDeleteRecord($id){
        $model = TblNarsco::find()->where(['id'=>$id])->one();
 
        $model->delete();
        return $this->redirect(['record-list']);

    }

    public function actionAddRecords()
    {
        $model = new TblNarsco();

        $model->scenario = 'add';

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // var_dump($model->r1);die;
                if ($model->rp == 0 && $model->r1 == 0 && $model->r4 == 0) {
                    Yii::$app->session->setFlash('warning', 'Haraf Maaf. Tiada Rekod dikemaskini');

                    return $this->redirect(['record-list', 'id' => $model->id]);
                } else {
                    $record_id = TblRecordsAdmin::find()->where(['no_sps_40' => $model->no_sps_40,'status'=>0,'rp'=>$model->rp,'r1'=>$model->r1,'r4'=>$model->r4])->one();
                    $model->added_by = Yii::$app->user->identity->id;
                    $model->record_id = $record_id->id;
                    $rekod_admin = TblRecordsAdmin::find()->where(['no_sps_40' => $model->no_sps_40,'status'=>0])->all();
                    foreach ($rekod_admin as $v) {
                        $v->status = '2';
                        $v->save(false);
                    }
                    $latestinout = TblBajaKeluarMasuk::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();
                    $inout = new TblBajaKeluarMasuk();
                    $inout->tarikh_keluar = $model->tarikh_keluar;

                    $inout->tarikh_masuk = NULL;
                    $inout->type = 2;

                    $inout->rp_keluar =  $model->rp;
                    $inout->rp_baki =  $latestinout->rp_baki - $model->rp;

                    $inout->r1_keluar = $model->r1;
                    $inout->r1_baki =  $latestinout->r1_baki - $model->r1;

                    $inout->r4_keluar = $model->r4;
                    $inout->r4_baki =  $latestinout->r4_baki - $model->r4;
                    $inout->narsco_id = $model->id;
                    $inout->save(false);
                    // $model->status
                    if ($model->save(false)) {

                        return $this->redirect(['record-list']);
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-records', [
            'model' => $model,

        ]);
    }
    public function actionDeleteInOut($id){
        $model = TblBajaKeluarMasuk::find()->where(['id'=>$id])->one();
 
        $model->delete();
        return $this->redirect(['record-list']);

    }
    public function actionIn()
    {
        $model = new TblBajaKeluarMasuk();

        // $model->scenario = 'in';
        $latestinout = TblBajaKeluarMasuk::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // var_dump($model->r1);die;
                $model->added_by = Yii::$app->user->identity->id;
                $model->type = 1;
                $model->rp_baki =  $latestinout->rp_baki + $model->rp_masuk;
                $model->r1_baki =  $latestinout->r1_baki + $model->r1_masuk;
                $model->r4_baki =  $latestinout->r4_baki + $model->r4_masuk;

                if ($model->save(false)) {
                       
                    return $this->redirect(['record-list']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('in', [
            'model' => $model,

        ]);
    }
    // public function action
    //get data
    public function actionGetSpsData()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    $id = Yii::$app->request->post('id');

    // Initialize sums to 0
    $rp = 0;
    $r1 = 0;
    $r4 = 0;

    $model = TblRecordsAdmin::find()->where(['no_sps_40' => $id, 'status' => 0]);

    if ($model->exists()) {
        $rp = $model->sum('rp');
        $r1 = $model->sum('r1');
        $r4 = $model->sum('r4');
    }

    return [
        'rp' => $rp,
        'r1' => $r1,
        'r4' => $r4
    ];
}

}
