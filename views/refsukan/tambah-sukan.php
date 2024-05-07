<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal form-label-left']]); ?>

<div class="col-md-12 col-sm-12 col-xs-6">
    
<!--    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program">Nama Sukan: </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <php echo
            $form->field($model, 'nama')->label(false)->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\app\models\sukum\Sukan::find()->all(), 'sukan_id', 'NamaSukan'),
                'options' => ['placeholder' => 'Pilih Nama Sukan', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => ['allowClear' => true ]
            ]);
            ?>
        </div>
    </div>-->

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Sukan: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'nama')->textArea(['maxlength' => true, 'rows' => 2])->label(false); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="program">Jenis Sukan: <span class="required" style="color:red;">*</span> </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php echo
            $form->field($model, 'jenis')->label(false)->widget(Select2::classname(), [
                'data' => ['1' => 'Permainan', '2' => 'Olahraga'],
                'options' => ['placeholder' => 'Pilih Jenis Sukan', 'class' => 'form-control col-md-7 col-xs-12'],
                'pluginOptions' => ['allowClear' => true ]
            ]);
            ?>   
        </div>
    </div>
     
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="statusjawatan">Status: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
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