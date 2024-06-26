<?php

use app\models\TblUsers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\TblUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'TAMBAH MODUL';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .uppercase {
        text-transform: uppercase;
    }
</style>

<div class="card card-primary card-outline heavy uppercase">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<?= Html::encode($this->title) ?></small></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i>&nbsp;Tambah Modul', ['admin/create-modul'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'modul',
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'format' => 'raw',
                    'filter' => [0 => 'Tidak Aktif', 1 => 'Aktif'],
                    'value' => function ($model) {
                        $badge = 'danger';
                        $text = 'Tidak Aktif';

                        if ($model->status === 1) {
                            $badge = 'success';
                            $text = 'Aktif';
                        }

                        return '<span class="right badge badge-' . $badge . '">' . $text . '</span>';
                    },
                ],
                [
                    'label' => '',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a('<i class="fas fa-edit"></i>', Url::to(['admin/update-modul', 'id' => $model->id]), ['class' => 'btn btn-primary btn-xs']);
                    }
                ],
                // [
                //     'label' => '',
                //     'format' => 'raw',
                //     'value' => function ($model) {
                //         return Html::a('<i class="fas fa-trash"></i>', Url::to(['users/delete', 'id' => $model->id]), ['class' => 'btn btn-danger btn-xs', 'data' => [
                //             'confirm' => 'Anda pasti untuk membuang pengguna ini ?',
                //             'method' => 'post',
                //         ],]);
                //     }
                // ]

            ],
        ]); ?>
    </div>
</div>