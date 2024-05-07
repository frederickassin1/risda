<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-unlock"></i>&nbsp;Lupa Kata Laluan</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <div class="callout callout-danger">

            <p style="color: red;">*Sila masukkan alamat email yang berdaftar dengan sistem ini. Pautan akan dihantar ke alamat emel tersebut.</p>
        </div>

        <?php $form = ActiveForm::begin(); ?>
        <?php //echo $form->errorSummary($model);
        ?>

        <?= $form->field($model, 'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => 'Alamat Emel']) ?>

        <div class="col-12">
            <?= Html::submitButton('Hantar&nbsp;<span class="fas fa-paper-plane"></span>', ['class' => 'btn btn-primary btn-block']) ?>
            <?= Html::a('<span class="fas fa-undo"></span>&nbsp;Kembali', Url::to('login'), ['class' => 'btn btn-warning btn-block']) ?>

        </div>

    </div>
    <?php ActiveForm::end(); ?>
    <br>
</div>