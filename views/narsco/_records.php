<?php

use app\models\TblPenerimaBaja;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<div class="ref-kategori-form">

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => false, 
    'options' => [
        'class' => 'form-horizontal form-label-left disable-submit-buttons', 
        'enctype' => 'multipart/form-data',
        'id' => 'my-form' // Added id for the form
    ]
]); ?>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarikh SPS: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'tarikh_keluar')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Tarikh Keluar ...', 'readonly' => true],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->label(false); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">NO SPS 42: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'no_sps_42')->label(false)->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TblPenerimaBaja::find()->where(['status' => 1])->all(), 'id', function ($model) {
                    return $model->fullname . '( ' . $model->no_sps . ' )';
                }),
                'options' => [
                    'placeholder' => 'Pilih SPS 42',
                    'class' => 'form-control col-md-7 col-xs-12',
                    'id' => 'no-sps-42-dropdown'
                ],
                'pluginOptions' => ['allowClear' => true]
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">NO SPS 40: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'no_sps_40')->label(false)->widget(Select2::classname(), [
                'data' => ArrayHelper::map(TblPenerimaBaja::find()->where(['status' => 1])->all(), 'id', function ($model) {
                    return $model->fullname . '( ' . $model->no_sps . ' )';
                }),
                'options' => [
                    'placeholder' => 'Pilih SPS 40',
                    'class' => 'form-control col-md-7 col-xs-12',
                    'id' => 'no-sps-40-dropdown'
                ],
                'pluginOptions' => ['allowClear' => true]
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">RP: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'rp')->label(false)->textInput(['id' => 'rp-field','readonly'=>true]) ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">R1: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'r1')->label(false)->textInput(['id' => 'r1-field','readonly'=>true]) ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">R4: <span class="required" style="color:red;">*</span></label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'r4')->label(false)->textInput(['id' => 'r4-field','readonly'=>true]) ?>
        </div>
    </div>

    <div class="form-group text-center">
        <?= Html::submitButton('<i class="fa fa-arrow-right"></i>&nbsp;Hantar', [
            'class' => 'btn btn-primary', 
            'data' => ['disabled-text' => 'Please Wait..'],
            'id' => 'submit-button' // Added id for the submit button
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("
    $('#no-sps-40-dropdown').on('change', function() {
        var selectedValue = $(this).val();

        if (selectedValue) {
            $.ajax({
                url: '" . Url::to(['narsco/get-sps-data']) . "',
                type: 'post',
                data: {
                    id: selectedValue,
                    _csrf: yii.getCsrfToken()
                },
                success: function(data) {
                    if (data) {
                        $('#rp-field').val(data.rp);
                        $('#r1-field').val(data.r1);
                        $('#r4-field').val(data.r4);
                    }
                }
            });
        } else {
            $('#rp-field').val('');
            $('#r1-field').val('');
            $('#r4-field').val('');
        }
    });

    $('#my-form').on('beforeSubmit', function() {
        var submitButton = $('#submit-button');
        submitButton.prop('disabled', true);
        var disabledText = submitButton.data('disabled-text');
        if (disabledText) {
            submitButton.html('<i class=\"fa fa-spinner fa-spin\"></i> ' + disabledText);
        }
        return true;
    });
");
?>
