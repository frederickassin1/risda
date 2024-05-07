<?php

namespace app\controllers;

use Yii;

use app\models\RefKategori;
use app\models\RefKategoriSearch;
use app\models\sukum\TblSukan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TblUsers;

/**
 * RefKategoriController implements the CRUD actions for RefKategori model.
 */
class RefkategoriController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all RefKategori models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RefKategoriSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefKategori model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefKategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RefKategori();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RefKategori model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = TblUsers::find()->where(['email' => Yii::$app->user->getId()])->one();
        $sukan = $this->findSukan($id);
            // var_dump($id);die;


        if ($this->request->isPost && $model->load($this->request->post())) {
            // $sukan->maks = $model->max;
            $model->update_by = $user->id;
            $model->update_dt = date('Y-m-d H:i:s');
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            // 'sukan' => $sukan,
        ]);
    }
    public function findSukan($id){
        if (($sukan = TblSukan::find()->where(['id' => $id])) !== null) {
            return $sukan;
        }       

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing RefKategori model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = 0; 
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the RefKategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return RefKategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefKategori::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTambahKategori()
    {
        $user = TblUsers::find()->where(['email' => Yii::$app->user->getId()])->one();
        $model = new RefKategori();

        
        if ($model->load(Yii::$app->request->post())) {
            
            

            //     $check = RefKategori::find()->where(['kategori' => $model->kategori])->one();
            //     if($check ){
            //         Yii::$app->session->setFlash('alert', ['title' => 'Harap Maaf', 'type' => 'error', 'msg' => 'Rekod telah wujud.']);
                
            //        return $this->redirect(['index']);
            //    }
            $model->create_by = $user->id;
            $model->created_dt = date('Y-m-d H:i:s');
                        
            $model->save(false);  
            $sukan = new TblSukan();
            $sukan->sukan = $model->sukan->nama;
            $sukan->kategori = $model->kategori;
            $sukan->created_dt = date('Y-m-d H:i:s');
            $sukan->create_by = $user->id;
            $sukan->status = 1;
            $sukan->yuran = $model->yuran;
            $sukan->maks = $model->maks;
            $sukan->jenis = $model->sukan->jenis;
            $sukan->save(false);
            
            Yii::$app->session->setFlash('success', 'Berjaya di tambah.');
            return $this->redirect(['index']);
        }

        return $this->render('tambah_kategori', [
            'model' => $model,
        ]);
    }
}
