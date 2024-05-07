<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblUsers $model */

$this->title = ' Sukan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Pengguna Berdaftar', 'url' => ['admin/user-list']];
$this->params['breadcrumbs'][] = $this->title;


\yii\web\YiiAsset::register($this);
?>
<div class="ref-sukan-view">

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

            <p>
                <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', ['index'], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'nama',
                    'jenisSukan',
                    [
                        'label' => 'Direkodkan pada',
                        'attribute' => 'created_dt',
                    ],
                    // 'created_dt',
                    //'create_by',
                    'user.fullname',
                    //'update_by',
                    //'update_dt',
                    'Status',
                    [
                        'label' => 'Kategori',
                        'attribute' => 'kategoris',
                    ],
                    
                ],
            ]) ?>

        </div>
    </div>
</div>
