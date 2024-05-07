<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblPeserta $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Peserta', 'url' => ['index-peserta']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-peserta-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

   
    <div class="card card-primary card-outline heavy">

    <div class="card-body">
        
    <p align="right"> 
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Kembali', ['index-peserta'], ['class' => 'btn btn-primary pull-right']) ?>
        <strong><h5>PROFIL PESERTA</h5></strong>

        <HR>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nokp',
            'nama',
            'no_telefon',
            'jantina_',
            'jawatan',
            'tarikh_lantikan',
            [
                'label'=>'Kontinjen',
                'attribute' =>'kontinjen.nama'

            ],
            'date_created',
        ],
    ]) ?>

</div>

