<?php

use app\models\RefModul;
use app\models\RefSpsGroup;
use app\models\TblPenerimaBaja;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$model->rp = 0;
$model->r1 = 0;
$model->r4 = 0;
?>
<style>
    .uppercase {
        text-transform: uppercase;
    }
</style>

<div class="ref-kategori-form uppercase">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarikh SPS: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'tarikh_sps')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter sps date ...'],
                // 'disabled' => true,

                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'

                ]
            ])->label(false);
            ?>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">NO SPS 42: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'no_sps_42')->label(false)->widget(Select2::classname(), [
                'data' => ArrayHelper::map(RefSpsGroup::find()->where(['status' => 1])->all(), 'id', 'sps_group'),
                'options' => ['placeholder' => 'Pilih SPS 42', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => ['allowClear' => true]
            ]);
            ?>

        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">NO SPS 40: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'no_sps_40')->label(false)->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TblPenerimaBaja::find()->where(['status' => 1])->all(), 'id', function ($model) {
                    return $model->fullname . '( ' . $model->no_sps . ' )';
                }),
                'options' => ['placeholder' => 'Pilih SPS 40', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => ['allowClear' => true]
            ]);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Modul: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'modul')->label(false)->widget(Select2::classname(), [
                'data' => ArrayHelper::map(RefModul::find()->where(['status' => 1])->all(), 'id', 'modul'),
                'options' => ['placeholder' => 'Pilih modul', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => ['allowClear' => true]
            ]);
            ?>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">RP: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'rp')->label(false)->textInput(['disabled' => false]) ?>

       
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">R1: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'r1')->label(false)->textInput(['disabled' => false]) ?>

       
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">R4: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'r4')->label(false)->textInput(['disabled' => false]) ?>

       
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Status: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'status')->label(false)->widget(Select2::classname(), [
                'data' => ['0' => 'IN STOCK', '1' => 'DONE','2'=> 'TRANSIT'],
                'options' => ['placeholder' => 'Pilih Status', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => [ 'allowClear' => true ]
            ]);
            ?>
        </div>
    </div>  
    <div class="form-group text-center">
        <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>