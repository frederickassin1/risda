<?php

use kartik\daterange\DateRangePicker;
use kartik\date\DatePicker;
use app\models\RefIpta;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/** @var yii\web\View $this */
/** @var app\models\TblPeserta $model */
/** @var yii\widgets\ActiveForm $form */
?>



<div class="tbl-users-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group col-md-12">
            <label>No Kad Pengenalan</label>
            <?= $form->field($model, 'nokp')->textInput(['maxlength' => true])->label(false)?>
    </div>
    <div class="form-group col-md-12">
            <label>Nama Penuh</label>
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <label>No Telefon</label>
            <?= $form->field($model, 'no_telefon')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <label>Jantina</label>
            <?= $form->field($model, 'jantina')->widget(Select2::class, [
                        'data' => ['L' => 'Lelaki', 'P' => 'Perempuan'],
                        'options' => ['placeholder' => '-select-', 'class' => 'form-control col-md-7 col-xs-12'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <label>Jawatan</label>
            <?= $form->field($model, 'jawatan')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <label>Tarikh Lantikan</label>
            <?php echo DatePicker::widget([
                'model' => $model, 
                'attribute' => 'tarikh_lantikan',
                'options' => ['placeholder' => 'Enter Tarikh Lantikan ...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy/mm/dd'
                ]
            ]);?>
    </div>
    
    <div class="form-group col-md-12">
            <label>Nama Kontinjen</label>
            <?= $form->field($model, 'id_kontinjen')->widget(Select2::class, [
                        'data' => ArrayHelper::map(RefIpta::find()->where([])->all(),'id', 'nama'),
                        'options' => ['placeholder' => '-select-', 'class' => 'form-control col-md-7 col-xs-12','disabled'=>true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false) ?>
    </div>
    <div class="form-group col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Kemaskini', ['class' => 'btn btn-warning']) ?>
            </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>