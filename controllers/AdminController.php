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
use app\models\RefModul;
use app\models\RefModulSearch;
use app\models\RefSpsGroup;
use app\models\RefSpsGroupSearch;
use app\models\RefYuran;
use app\models\sukum\ListSukan;
use app\models\sukum\RefSukan;
use app\models\TblSetup;
use app\models\TblSetupSearch;
use app\models\sukum\TblPendaftaran;
use app\models\sukum\TblPendaftaranSearch;
use app\models\sukum\TblSukan;
use app\models\sukum\TblSukanSearch;
use app\models\TblPenerimaBaja;
use app\models\TblPenerimaBajaSearch;
use app\models\TblPenyertaan;
use app\models\TblRecordsAdmin;
use app\models\TblRecordsAdminSearch;
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
                    'only' => ['*'],
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
    public function actionReceipentList()
    {
        $searchModel = new TblPenerimaBajaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('receipent-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionSpsList()
    {
        $searchModel = new RefSpsGroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('spsgrp-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionRecordList()
    {
        $searchModel = new TblRecordsAdminSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('record-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreateSps()
    {
        $model = new RefSpsGroup();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['sps-list', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-sps', [
            'model' => $model,
        ]);
    }
    public function actionCreateReceipent()
    {
        $model = new TblPenerimaBaja();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['receipent-list', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-sps', [
            'model' => $model,
        ]);
    }
    public function actionCreateModul()
    {
        $model = new RefModul();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['modul-list', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create-modul', [
            'model' => $model,
        ]);
    }
    public function actionModulList()
    {
        $searchModel = new RefModulSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('modul-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    //add new records
    public function actionAddRecords($sps_grp = null, $date = null)
    {
        $model = new TblRecordsAdmin();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $pekebun = TblPenerimaBaja::findOne(['id' => $model->no_sps_42]);
                // var_dump($model->no_sps_42);die;
                $model->nama_pekebun = $pekebun->fullname != NULL ? $pekebun->fullname : $model->nama_pekebun;
                if ($model->save(false)) {
                    return $this->redirect(['record-list']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add-records', [
            'model' => $model,
        ]);
    }
    // public function action

}
