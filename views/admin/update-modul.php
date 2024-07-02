<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblUsers $model */

$this->title = 'KEMASKINI MODUL';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Penguna', 'url' => ['admin/user-list']];
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
    <div class="card-body">
        <?= $this->render('_modul', [
            'model' => $model,
        ]) ?>

    </div>
</div>