<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\sukum\RefSukan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-users-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    <= $form->field($model, 'id')->textInput() ?>-->

    <?= $form->field($model, 'nama')->textArea(['maxlength' => true]) ?>

<!--    <= $form->field($model, 'jenis')->textInput() ?>-->

   <?= $form->field($model, 'jenis')->dropDownList(['1' => 'Permainan', '2' => 'Olahraga']) ?>

<!--    <= $form->field($model, 'created_dt')->textInput() ?>

    <= $form->field($model, 'create_by')->textInput(['maxlength' => true]) ?>

    <= $form->field($model, 'update_by')->textInput(['maxlength' => true]) ?>

    <= $form->field($model, 'update_dt')->textInput() ?>-->

   <?= $form->field($model, 'status')->dropDownList(['1' => 'Aktif', '2' => 'Tidak Aktif']) ?>
   <?= $form->field($model, 'kategori')->dropDownList(['1' => 'Berpasukan', '2' => 'Berkumpulan']) ?>

    <div class="form-group text-center">
<!--        <= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', Url::to(['index']), ['class' => 'btn btn-default']) ?>-->
        <?= Html::submitButton('<i class="fas fa-save"></i>&nbsp;Kemaskini', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>