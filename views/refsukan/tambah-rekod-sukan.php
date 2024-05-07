<?php

use yii\helpers\Html;

$this->title = 'Tambah Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Tblrscoadminposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <?= $this->render('tambah-sukan', [
            'model' => $model,
        ]) ?>

    </div>
</div>