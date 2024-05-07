<?php

use app\models\TblPeserta;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblPesertaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'SENARAI PESERTA';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary card-outline heavy">
    
    <div class="card-header"
    3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
            MAKLUMAT KONTIJEN</small>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <div class="row">
                <label class="control-label col-md-3 col-sm-3 col-xs-4 text-right">NAMA PENDAFTAR: </label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                    <?= $form->field($model, 'created_by')->textInput(['value' => $model->pendaftar->fullname, 'disabled' => true])->label(false); ?>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="row">
                <label class="control-label col-md-3 col-sm-3 col-xs-4 text-right">IPTA/KONTINJEN: </label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                    <?= $form->field($model, 'created_by')->textInput(['value' => $model->pendaftar->ipta->nama, 'disabled' => true])->label(false); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <label class="control-label col-md-3 col-sm-3 col-xs-4 text-right">TARIKH & MASA PENDAFTARAN: </label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                    <?= $form->field($model, 'created_dt')->textInput(['disabled' => true])->label(false); ?>
                </div>
            </div>
        </div>





        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="tbl-peserta-index">



    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card card-primary card-outline heavy">
        <div class="card-header">


            <h3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
                <?= Html::encode($this->title) ?></small>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <p align="left"><?= Html::a('<i class="fa fa-users"></i> Tambah Peserta ', ['create'], ['class' => 'btn btn-primary btn-sm']); ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,

                'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'NAMA PESERTA',
                        'attribute' => 'nama',
                        'value' => function ($data) {
                            return $data->nama;
                        },
                    ],
                    [
                        'label' => 'NO. TELEFON',
                        'attribute' => 'ipta_id',
                        'value' => function ($data) {
                            return $data->no_telefon;
                        },
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'label' => 'JANTINA',
                        'attribute' => 'ipta_id',
                        'value' => function ($data) {
                            return $data->jantina_;
                        },
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                 
                    [
                        'label' => 'KEMASKINI PROFIL',
                        'value' => function ($model) {
                            return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', [
                                'view',
                                'id' => $model->id,
                            ], [
                                'class' => 'btn btn-warning btn-xs',
                                //                                        'target' => '_blank',
                            ]) . ' | ' .
                                Html::a('<i class="fa fa-edit" aria-hidden="true"></i>', [
                                    'update',
                                    'id' => $model->id,
                                ], [
                                    'class' => 'btn btn-warning btn-xs',
                                    //                                        'target' => '_blank',
                                ]) . ' | ' .
                                Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', [
                                    'delete',
                                    'id' => $model->id,
                                ], [
                                    'class' => 'btn btn-warning btn-xs',
                                    //                                        'target' => '_blank',
                                ]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 15%;'],

                    ],

                    [
                        'label' => 'DAFTAR PERMAINAN',
                        'value' => function ($model) {
                            return Html::a('<i class="fa fa-plus-square" aria-hidden="true"></i>', [
                                'daftar-permainan-pemain',
                                'id' => $model->id,
                            ], [
                                'class' => 'btn btn-info btn-xs',
                                //                                        'target' => '_blank',
                            ]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 15%;'],

                    ],
                ],
            ]); ?>
        </div>



    </div>
</div>