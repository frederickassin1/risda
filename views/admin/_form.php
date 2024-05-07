<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
 
// $model->maks = $sukan->maks;
?>

<div class="ref-kategori-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Sukan: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'sukan')->label(false)->textInput(['disabled' => true]) ?>

       
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program">Kategori: <span class="required" style="color:red;">*</span> </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'kategori')->textInput(['maxlength' => true,'disabled'=>true])->label(false);?>
        
        </div>
    </div>
     
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Yuran: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'yuran')->textInput(['maxlength' => true])->label(false);
            ?>
        </div>
    </div>  
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Jumlah Maksimum Pemain: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'maks')->textInput(['maxlength' => true])->label(false);
            ?>
        </div>
    </div>  
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Jumlah Maksimum Pengurus: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'pengurus')->textInput(['maxlength' => true])->label(false);
            ?>
        </div>
    </div>  
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Status: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'status')->label(false)->widget(Select2::classname(), [
                'data' => ['1' => 'Dipertandingkan', '2' => 'Tidak Dipertandingkan'],
                'options' => ['placeholder' => 'Pilih Status', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => [ 'allowClear' => true ]
            ]);
            ?>
        </div>
    </div>  
    <div class="form-group text-center"> 
<!--        <= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', Url::to(['index']), ['class' => 'btn btn-default']) ?> -->
        <?= Html::submitButton('Kemaskini', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
