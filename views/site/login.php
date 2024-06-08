<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

?>

<div class="card">
    <div class="login-box">

        <div class="card card-outline card-info">
            <div class="card-header text-center">
                <a href="<?= Yii::$app->homeUrl ?>" class="h3"><b>Supply Monitoring System (SMS)</b></a>



            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    SELAMAT DATANG
                </p>

                <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

                <?= $form->field($model, 'username', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])
                    ->label(false)
                    ->textInput(['placeholder' => 'Alamat Emel']) ?>

                <?= $form->field($model, 'password', [
                    'options' => ['class' => 'form-group has-feedback'],
                    'inputTemplate' => '{input}<div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>',
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => ['class' => 'input-group mb-3']
                ])
                    ->label(false)
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

                <div class="row">
                    <div class="col-8">
                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => '<div class="icheck-primary">{input}{label}</div>',
                            'labelOptions' => [
                                'class' => ''
                            ],
                            'uncheck' => null
                        ]) ?>
                    </div>
                    <div class="col-12">
                        <?= Html::submitButton('<span class="fas fa-sign-in-alt"></span>&nbsp;Log Masuk', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>

                </div>

                <?php ActiveForm::end(); ?>
                
                <div class="pt-3">
                <hr>
                   

                    <!-- <p class="mb-1 float-left">
                        <?= Html::a('Lupa Kata Laluan', Url::to(['site/forgot-password'])) ?>
                    </p> -->

                    <!-- <p class="mb-1 float-right">
                        <?= Html::a('<span class="fas fa-book"></span>&nbsp;Manual Pengguna', Url::to('@web/public/MANUAL PENGGUNA SISTEM.pdf', true), ['class' => 'btn btn-info btn-sm', 'target' => '_blank']) ?>
                    </p> -->
                </div>
            </div>

            <!-- /.login-card-body -->
        </div>
    </div>
</div>