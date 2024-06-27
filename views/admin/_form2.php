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
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Kumpulan SPS 42: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'sps_group')->label(false)->textInput(['disabled' => false]) ?>

       
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Status: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'status')->label(false)->widget(Select2::classname(), [
                'data' => ['0' => 'Tidak Aktif', '1' => 'Aktif'],
                'options' => ['placeholder' => 'Pilih Status', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => [ 'allowClear' => true ]
            ]);
            ?>
        </div>
    </div>  
    <div class="form-group text-center"> 
<!--        <= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', Url::to(['index']), ['class' => 'btn btn-default']) ?> -->
        <?= Html::submitButton('Hantar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
