<?php

use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;Daftar Akaun Baharu</h3>
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

        <?= $form->field($model, 'fullname', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => 'Nama Penuh']) ?>

        <?= $form->field($model, 'email', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => 'Emel']) ?>

        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => 'Kata Laluan']) ?>

        <?= $form->field($model, 'password_repeat', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => 'Ulang Kata Laluan']) ?>




        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <?= $form->field($model, 'term')->checkbox([
                        // 'label' => Yii::t('app', 'Mock recall'),
                        'checked' => false,
                        'uncheck' => null,
                    ]); ?>
                </div>
            </div>

            <div class="col-4">
                <?= Html::submitButton('<span class="fas fa-sign-in-alt"></span>&nbsp;Daftar', ['class' => 'btn btn-primary btn-block']) ?>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
        <br>
        <?= html::a('Saya telah mempunyai akaun', Url::to(['site/login'])) ?>
        <?php
        echo Html::button('<i class="fas fa-book"></i>&nbsp; Terma & Makluman', [

            'class' => 'btn btn-info btn-sm modalClassButton',
            'data-toggle' => 'tooltip',
            'data-original-title' => 'Klik menjawab Soal-selidik',
            'data-url' => \yii\helpers\Url::to(['site/terma']) // replace 'controller/action' with the appropriate route
        ]);
        ?>
    </div>

</div>