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
class FleetController extends Controller
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
                                return $user && ($user->type == 1 || $user->type == 2); // Ensure the user is an admin
                            }
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        throw new ForbiddenHttpException('You do not have permission to access this page.');
                    },
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [],
                ],
            ]
        );
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
    // public function actionAddRecords($sps_grp = null,$date = null)
    // {
    //     $model = new TblRecordsAdmin();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('add-records', [
    //         'model' => $model,
    //     ]);
    // }
    // public function action

}
