 <?php

use app\models\RefKategori;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = 'Tambah Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal form-label-left']]); ?>
<!-- <div class="col-md-12 col-xs-12">  -->

    <!-- <div class="row">  -->
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<?= Html::encode($this->title) ?></small></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-6">
    <div class="card-body">
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Sukan: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?=
            $form->field($model, 'sukan_id')->label(false)->widget(Select2::classname(), [
            'data' => ArrayHelper::map(app\models\RefSukan::find()->all(), 'id', 'nama'),
            'options' => ['placeholder' => 'Pilih Sukan', 'class' => 'form-control col-md-7 col-xs-12'],
            'pluginOptions' => [
                'allowClear' => true
            ],
            ]);
        ?> 
       
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program">Kategori: <span class="required" style="color:red;">*</span> </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'kategori')->textInput(['maxlength' => true]) ->label(false);?>
        
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
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Status: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?=
            $form->field($model, 'status')->label(false)->widget(Select2::classname(), [
                'data' => ['1' => 'Aktif', '2' => 'Tidak Aktif'],
                'options' => ['placeholder' => 'Pilih Status', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => [ 'allowClear' => true ]
            ]);
            ?>
        </div>
    </div>   
     
    <br>
    
    <div class="form-group text-center">
        <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', Url::to(['index']), ['class' => 'btn btn-default']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i>&nbsp;Simpan', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div> 
    </div>
    
</div>

<!-- </div>
</div> -->