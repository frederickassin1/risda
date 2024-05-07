<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblPesertaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-peserta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nokp') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'no_telefon') ?>

    <?= $form->field($model, 'jantina') ?>

    <?php // echo $form->field($model, 'jawatan') ?>

    <?php // echo $form->field($model, 'tarikh_lantikan') ?>

    <?php // echo $form->field($model, 'id_kontinjen') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
