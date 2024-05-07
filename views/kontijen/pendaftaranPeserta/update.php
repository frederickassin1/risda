<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblPeserta $model */

// $this->title = 'Update Tbl Peserta: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Peserta', 'url' => ['index-peserta']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="tbl-peserta-update">
<div class="card card-primary card-outline heavy">

    <div class="card-body">
    <strong><h5>KEMASKINI PROFIL PESERTA</h5></strong>

<HR>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>