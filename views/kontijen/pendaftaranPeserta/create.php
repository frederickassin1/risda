<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblPeserta $model */

$this->title = 'Tambah Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Tambah Peserta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Peserta</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


<div>
