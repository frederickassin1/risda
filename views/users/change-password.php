<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
?>

<div class="alert alert-danger">
    <h5><i class="icon fas fa-ban"></i> Perhatian !</h5>
    Anda perlu log-semula ke dalam sistem menggunakan kata-laluan baharu sekiranya berjaya menukar kata-laluan
</div>


<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-key"></i>&nbsp;<strong>Tukar Kata Laluan</strong></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'current_password')->passwordInput(['maxlength' => true, 'autocomplete' => false])->label('Kata Laluan Semasa'); ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'autocomplete' => false])->label('Kata Laluan Baharu'); ?>
        <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true, 'autocomplete' => 'off'])->label('Ulang Kata Laluan Baharu'); ?>

        <div class="form-group">
            <?= html::resetButton('Reset', ['class' => 'btn btn-danger']); ?>
            <?= Html::submitButton('Tukar Kata Laluan', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>