<?php

use app\models\RefIpta;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm; // or kartik\widgets\ActiveForm

/** @var yii\web\View $this */
/** @var app\models\TblUsers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-hotel"></i>&nbsp;Pendaftaran Penginapan</small></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php
        $form = ActiveForm::begin([
            'id' => 'login-form-horizontal',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
        ?>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'pegawai_lelaki')->input('number', ['min' => 1, 'max' => 100, 'placeholder' => 'Masukkan Bilangan', 'style' => 'width:20%']) ?>

        <?= $form->field($model, 'pegawai_wanita')->input('number', ['min' => 1, 'max' => 100, 'placeholder' => 'Masukkan Bilangan', 'style' => 'width:20%']) ?>

        <?= $form->field($model, 'atlet_lelaki')->input('number', ['min' => 1, 'max' => 100, 'placeholder' => 'Masukkan Bilangan', 'style' => 'width:20%']) ?>

        <?= $form->field($model, 'atlet_wanita')->input('number', ['min' => 1, 'max' => 100, 'placeholder' => 'Masukkan Bilangan', 'style' => 'width:20%']) ?>

        <?= $form->field($model, 'keseluruhan')->input('number', ['id' => 'keseluruhan', 'readonly' => true, 'placeholder' => 'Masukkan Bilangan', 'style' => 'width:20%']) ?>

        <div class="form-group">
            <?= Html::submitButton('<i class="fas fa-save"></i>&nbsp;Simpan', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$script = <<< JS
$(document).ready(function(){
    // Function to calculate sum
    function calculateSum() {
            var sum = 0;
            // Add each number to the sum
            $('input[type="number"]').not('#keseluruhan').each(function() {
                sum += +$(this).val();
            });
            // Update the 'keseluruhan' field
            $('#keseluruhan').val(sum);
        }

        // Trigger sum calculation whenever a number field changes
        $('input[type="number"]').not('#keseluruhan').on('input', function() {
            calculateSum();
        });
    });
JS;
$this->registerJs($script);
?>