<?php

use app\models\TblPeranan;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\sukum\TblPendaftaran $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'MAKLUMAT PENDAFTARAN';
?>



<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-university"></i>&nbsp;
            MAKLUMAT KONTIJEN</small>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered jambo_table table-striped ">

                <tr class="headings">
                    <th class="column-title text-center" style="background-color:#192841;color:white" colspan="4">
                        <?= $model->ipta->nama; ?></th>

                </tr>

                <tr>
                    <td class="text-left">NAMA</td>

                    <td class="text-left" colspan="3"><?= $model->fullname ?></td>

                </tr>

                
                <tr>
                    <td class="text-left">EMEL</td>
                    <td class="text-left" colspan="3"> <?= $form->field($model, 'email')->textInput([ 'disabled' => true])->label(false); ?>
                    </td>

                </tr>

                <tr>
                    <td class="text-left">NO. TELEFON</td>
                    <td class="text-left" colspan="3"> <?= $form->field($model, 'no_tel')->textInput([ 'disabled' => false])->label(false); ?>
                    </td>

                </tr>

               

                


            </table>
        </div>


        <hr>



        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <?= Html::submitButton('Kemaskini', ['class' => 'btn btn-success', 'data'=>['disabled-text' => 'Sila Tunggu..']]) ?>
                <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', ['senarai-pendaftaran'], ['class' => 'mapBtn btn btn-primary']) ?>

            </div>
        </div>


        <?php ActiveForm::end(); ?>

    </div>


</div>


<hr>