<?php

namespace app\controllers;

use Yii;
use app\models\RefSukan;
use app\models\RefSukanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefSukanController implements the CRUD actions for RefSukan model.
 */
class RefsukanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RefSukan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RefSukanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RefSukan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RefSukan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RefSukan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RefSukan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $admin=Yii::$app->user->getId();
        $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post())) {
            
            $model->update_by = $admin;
            $model->update_dt = date('Y-m-d H:i:s');
                        
            $model->save(false);  
                        
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RefSukan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
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
     * Finds the RefSukan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RefSukan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RefSukan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionTambahRekodSukan()
    {
        //$admin=Yii::$app->user->getId();
        $admin= \app\models\TblUsersSearch::find()->where(['email' => Yii::$app->user->getId()])->one();
        $model = new RefSukan();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->create_by = $admin->id;
            $model->created_dt = date('Y-m-d H:i:s');
                        
            $model->save(false);  
                        
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('tambah-rekod-sukan', [
            'model' => $model,
        ]);
    }
}
