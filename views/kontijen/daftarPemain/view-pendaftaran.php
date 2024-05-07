<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
error_reporting(0);

$this->title = 'MAKLUMAT PENDAFTARAN';
?>
<p align="right"><?=  Html::a(' Kembali ', ['senarai-pendaftaran'], ['class' => 'btn btn-primary btn-sm']);?>
    </p>
        <h
<div class="card card-primary card-outline heavy">
    
    <div class="card-header"
    3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
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
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'Bil.'
                    ],
                 
                    [
                        'label' => 'PERMAINAN & KATEGORI',
                        'contentOptions' => ['class' => 'text-left', 'style' => 'width:90%'],
                        'attribute' => 'sukan.fullname',
                        'format' => 'raw'
                    ],

                    [
                        'label' => 'Daftar Pemain',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:90%'],
                        'value'=>function($model){
                            return  Html::a('<i class="fa fa-eye"></i>', ['senarai-pemain','id'=>$model->id],['class'=>'btn btn-primary btn-sm']);
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
