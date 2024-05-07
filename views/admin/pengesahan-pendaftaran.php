<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\sukum\TblPendaftaran $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Maklumat Pendaftaran';
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


        <div class="form-group">
            <div class="row">
                <label class="control-label col-md-3 col-sm-3 col-xs-4 text-right">STATUS: <span class="required" style="color:red;">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                    <?= $form->field($model, 'status')->dropDownList([
                        '0' => 'DRAF', 
                        '1' => 'TELAH DIDAFTAR',
                        '2' => 'DISAHKAN',
                        '3' => 'SELESAI'])->label(false) ?>
                </div>
            </div>
        </div><br>

        <div class="form-group" style="text-align: right;">
            <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', ['senarai-pendaftaran'], ['class' => 'mapBtn btn btn-default']) ?>
            <?= Html::submitButton('<i class="fas fa-save"></i>&nbsp;Simpan', ['class' => 'btn btn-success']) ?>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>
    <div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-check"></i>&nbsp;
            SENARAI PERMAINAN YANG DIDAFTARKAN</small>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php
        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                //'attribute' => 'CONm',
                'label' => 'PERMAINAN',
                'headerOptions' => ['class' => 'text-left'],
                'options' => ['style' => 'width:40%'],

                //                            'contentOptions' => ['class'=>'text-center'],
                'value' => function ($model) {
                    return '<span class="badge badge-warning">' . $model->sukan->sukan;
                },
                'format' => 'html',
                'group' => true,
            ],
            [
                'attribute' => 'sukanID',
                'label' => 'KATEGORI',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-left', 'style' => 'width:90%'],
                'value' => function ($model) {
                    return  $model->sukan->kategori;
                },
                'format' => 'raw',

            ],
          
            [
                'attribute' => 'yuran',
                'label' => 'YURAN',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:10%'],
                'value' => function ($model) {
                    return '<span class="badge badge-warning">RM' . $model->sukan->yuran . '</strong></span>';
                },
                'format' => 'raw'
            ],

            [
                // 'attribute' => 'yuran',
                'label' => 'JUMLAH (ORANG)',
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:10%'],
                'value' => function ($model) {

                    return '<span class="badge badge-info">' . $model->total . '</strong></span>';
                },
                'format' => 'raw'
            ],



        ];

        echo GridView::widget([
            // 'dataProvider' => $dataProvider,
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'containerOptions' => ['style' => 'overflow: auto'],
            'beforeHeader' => [
                [
                    'columns' => [],
                    'options' => ['class' => 'skip-export']
                ]
            ],
            'toolbar' => [],
            'bordered' => true,
            'striped' => false,
            'condensed' => false,
            'responsive' => true,
        ]);
        ?>
    </div>
</div>
