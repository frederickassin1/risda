<?php

use app\models\RefKategori;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?> 
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<?= Html::encode($this->title) ?></small></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"> 
                <i class="fas fa-minus"></i> 
            </button> 
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-6">
    <div class="card-body">
    <p>
    <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', Url::to(['index']), ['class' => 'btn btn-default']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [ 
            'sukan.nama',
            'kategori',
            [
            'label' => 'Ditambah pada',
            'attribute' => 'created_dt',
            ],
            [
            'label' => 'Ditambah Oleh',
            'attribute' => 'user.fullname',
            ],
            'Status',
        ],
    ]) ?>
    </div> 
    </div>
    
</div> 