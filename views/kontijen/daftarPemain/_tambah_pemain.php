<?php

use kartik\daterange\DateRangePicker;
use kartik\date\DatePicker;
use app\models\RefIpta;
use app\models\TblPeranan;
use app\models\TblPeserta;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

?>



<div class="tbl-users-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group col-md-12">
            <label>NAMA PESERTA</label>
            <?= $form->field($model, 'icno')->widget(Select2::class, [
                        'data' => ArrayHelper::map(TblPeserta::find()->where(['id_kontinjen'=>Yii::$app->user->identity->ipta_id])->all(),'nokp', 'nama'),
                        'options' => ['placeholder' => '-pilih pemain-', 'class' => 'form-control col-md-7 col-xs-12'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <label>PERANAN</label>
            <?= $form->field($model, 'role')->widget(Select2::class, [
                        'data' => ArrayHelper::map(TblPeranan::find()->where(['status'=>'1'])->all(),'id', 'peranan'),
                        'options' => ['placeholder' => '-pilih peranan-', 'class' => 'form-control col-md-7 col-xs-12'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <div class="form-group text-center">
                <?= Html::submitButton('SIMPAN', ['class' => 'btn btn-success']) ?>
            </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>