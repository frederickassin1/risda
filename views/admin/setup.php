<?php

use kartik\daterange\DateRangePicker;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\sport\TbleventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$addon = <<< HTML
<span class="input-group-text">
    <i class="fas fa-calendar-alt"></i>
</span>
HTML;
?>


<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tetapan</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal form-label-left disable-submit-buttons', 'enctype' => 'multipart/form-data']]); ?>


    <div class="card-body">
        <div class="form-group col-md-12">
            <label>Keterangan Kejohanan</label>
            <?= $form->field($model, 'keterangan_kejohanan')->textarea(['rows' => 4])->label(false); ?>
        </div>
        <div class = "row">
            <div class="form-group col-md-6">
                <label>Tarikh Kejohanan</label>
                <?php
                echo '<div class="input-group drp-container">';
                echo DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'fulldate_kejohanan',
                    'useWithAddon' => true,
                    'convertFormat' => true,
                    'disabled' => true,
                    'startAttribute' => 'start_kejohanan',
                    'endAttribute' => 'end_kejohanan',
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                    ],
                    'pluginEvents' => [
                        'apply.daterangepicker' => 'function(ev, picker) {
                        if($(this).val() == "") {
                            picker.callback(picker.startDate.clone(), picker.endDate.clone(), picker.chosenLabel);
                        }
                    }',
                    ]
                ]) . $addon;
                echo '</div>';
                ?>

            </div>
            <div class="form-group col-md-6">
                <label>Tarikh Pra Pendaftaran</label>
                <?php
                echo '<div class="input-group drp-container">';
                echo DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'fulldate_pra',
                    'useWithAddon' => true,
                    'convertFormat' => true,
                    'disabled' => true,
                    'startAttribute' => 'start_pra',
                    'endAttribute' => 'end_pra',
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                    ],
                    'pluginEvents' => [
                        'apply.daterangepicker' => 'function(ev, picker) {
                        if($(this).val() == "") {
                            picker.callback(picker.startDate.clone(), picker.endDate.clone(), picker.chosenLabel);
                        }
                    }',
                    ]
                ]) . $addon;
                echo '</div>';
                ?>

            </div>
        </div>
        <div class = "row">
            <div class="form-group col-md-6">
                <label>Tarikh Pengesahan Penyertaan Acara</label>
                <?php
                echo '<div class="input-group drp-container">';
                echo DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'fulldate_pengesahan',
                    'useWithAddon' => true,
                    'convertFormat' => true,
                    'disabled' => true,
                    'startAttribute' => 'start_pengesahan',
                    'endAttribute' => 'end_pengesahan',
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                    ],
                    'pluginEvents' => [
                        'apply.daterangepicker' => 'function(ev, picker) {
                        if($(this).val() == "") {
                            picker.callback(picker.startDate.clone(), picker.endDate.clone(), picker.chosenLabel);
                        }
                    }',
                    ]
                ]) . $addon;
                echo '</div>';
                ?>

            </div>
            <div class="form-group col-md-6">
                <label>Tarikh Pendaftaran Q-Form dan I-Form</label>
                <?php
                echo '<div class="input-group drp-container">';
                echo DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'fulldate_qform',
                    'useWithAddon' => true,
                    'convertFormat' => true,
                    'disabled' => true,
                    'startAttribute' => 'start_qform',
                    'endAttribute' => 'end_qform',
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                    ],
                    'pluginEvents' => [
                        'apply.daterangepicker' => 'function(ev, picker) {
                        if($(this).val() == "") {
                            picker.callback(picker.startDate.clone(), picker.endDate.clone(), picker.chosenLabel);
                        }
                    }',
                    ]
                ]) . $addon;
                echo '</div>';
                ?>

            </div>
        </div>
        <div class="form-group col-md-12">
            <label>Kod Kejohanan</label>
            <?= $form->field($model, 'kod_kejohanan')->textInput()->label(false); ?>
        </div>



        <!-- /.card-body -->

        <div class="card-footer">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= Html::resetButton('<span class="fa fa-repeat"></span>&nbsp;Reset', ['class' => 'btn btn-danger', 'name' => 'reset-button']) ?>
                <?= Html::submitButton('<i class="fa fa-arrow-right"></i>&nbsp;Submit', ['class' => 'btn btn-primary', 'data' => ['disabled-text' => 'Please Wait..']]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>