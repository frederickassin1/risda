<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblUsers $model */

$this->title = 'Profil Pengguna ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Pengguna Berdaftar', 'url' => ['admin/user-list']];
$this->params['breadcrumbs'][] = $this->title;


\yii\web\YiiAsset::register($this);
?>
<div class="tbl-users-view">

    <div class="card card-primary card-outline heavy">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<strong><?= Html::encode($this->title) ?></strong></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            <p>
                <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', ['admin/user-list'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('<i class="fas fa-edit"></i>&nbsp;Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'ipta.nama',
                    'fullname',
                    'email:email',
                    'userType',
                    'statusText',
                    'create_dt',
                    'updatedBy.fullname',
                    'update_dt',
                ],
            ]) ?>

        </div>
    </div>
</div>