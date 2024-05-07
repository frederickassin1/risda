<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-key"></i>&nbsp;Sila Masukkan Kata Laluan Baharu</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>
        <?php //echo $form->errorSummary($model);
        ?>
        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="col-12">
            <?= Html::submitButton('<span class="fas fa-sign-in-alt"></span>&nbsp;Hantar', ['class' => 'btn btn-primary btn-block']) ?>

       </div>

    </div>
    <?php ActiveForm::end(); ?>
</div>