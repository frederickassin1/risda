<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\ForbiddenHttpException;
use app\models\AverageCalculator;
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
        $searchModel2 = new TblInOutBajaSearch();
        $dataProvider2 = $searchModel2->search($this->request->queryParams);

        return $this->render('record-list', [
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
    public function actionAddRecords()
    {
        $model = new TblNarsco();

        $model->scenario = 'add';

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // var_dump($model->r1);die;
                if ($model->rp == 0 && $model->r1 == 0 && $model->r4 == 0) {
                    Yii::$app->session->setFlash('warning', 'Haraf Maaf. Rekod telah pun dikemaskini');

                    return $this->redirect(['record-list', 'id' => $model->id]);
                } else {
                    $model->added_by = Yii::$app->user->identity->id;
                    // if ($model->tarikh_keluar != NULL && $model->rp != 0) {
                    //     $model->rp_keluar = $model->rp;
                    //     // $model->rp_baki = TblNarsco::baki('rp') - $model->rp;
                    // }
                    // if ($model->tarikh_keluar != NULL && $model->r1 != 0) {
                    //     $model->r1_keluar = $model->r1;
                    //     // $model->r1_baki = TblNarsco::baki('r1') - $model->r1;
                    // }
                    // if ($model->tarikh_keluar != NULL && $model->r4 != 0) {
                    //     $model->r4_keluar = $model->r4;
                    //     // $model->r4_baki = TblNarsco::baki('r4') - $model->r4;
                    // }
                    // var_dump($model->r4_baki);die;
                    $rekod_admin = TblRecordsAdmin::find()->where(['no_sps_40' => $model->no_sps_40])->all();
                    foreach ($rekod_admin as $v) {
                        $v->status = '2';
                        $v->save(false);
                    }
                    $latestinout = TblInoutBaja::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();
                    $inout = new TblInoutBaja();
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
    public function actionIn()
    {
        $model = new TblInoutBaja();

        // $model->scenario = 'in';
        $latestinout = TblInoutBaja::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();

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
        $model = TblRecordsAdmin::find()->where(['no_sps_42' => $id, 'status' => 0]);
        $rp = $model->sum('rp');
        $r1 = $model->sum('r1');
        $r4 = $model->sum('r4');

        if ($model) {
            return [
                'rp' => $rp,
                'r1' => $r1,
                'r4' => $r4
            ];
        }

        return null;
    }
}
