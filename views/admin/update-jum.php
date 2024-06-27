<?php

use app\models\TblPenerimaBaja;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit">&nbsp;Kemaskini Jumlah Baja</i>&nbsp;<?= Html::encode($this->title) ?></small></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
     
<div class="ref-kategori-form">

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => false, 
    'options' => [
        'class' => 'form-horizontal form-label-left disable-submit-buttons', 
        'enctype' => 'multipart/form-data',
        'id' => 'my-form' // Added id for the form
    ]
]); ?>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarikh Baja Masuk: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'tarikh_masuk')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Tarikh Masuk ...', 'readonly' => true],
            'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    
                ]
            ])->label(false); ?>
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">RP: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'rp_baki')->label(false)->textInput(['id' => 'rp-field','readonly'=>false]) ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">R1: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'r1_baki')->label(false)->textInput(['id' => 'r1-field','readonly'=>false]) ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">R4: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'r4_baki')->label(false)->textInput(['id' => 'r4-field','readonly'=>false]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nota: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'description')->label(false)->textarea(['id' => 'r4-field','readonly'=>false]) ?>
        </div>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('<i class="fa fa-arrow-right"></i>&nbsp;Hantar', [
            'class' => 'btn btn-primary', 
            'data' => ['disabled-text' => 'Please Wait..'],
            'id' => 'submit-button' // Added id for the submit button
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

    </div>
</div>