<?php

use app\models\RefIpta;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblUsers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'ipta_id')->dropDownList(ArrayHelper::map(RefIpta::find()->where([])->all(),'id', 'nama')); ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(['0' => 'Pengguna Biasa', '1' => 'Administrator']) ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Tidak Aktif', '1' => 'Aktif']) ?>

    <div class="form-group text-center">
        <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', Url::to(['admin/user-list', 'id' => $model->id]), ['class' => 'btn btn-default']) ?>
        <?= Html::submitButton('<i class="fas fa-save"></i>&nbsp;Simpan', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>