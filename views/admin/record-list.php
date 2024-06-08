<?php

use app\models\TblUsers;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\TblUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Rekod';
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
        <p>
            <?= Html::a('<i class="fas fa-plus"></i>&nbsp;Tambah Rekod', ['admin/add-records'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'tarikh_sps',
                [
                    'attribute' => 'tarikh_sps',
                    'filter' => DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'tarikh_sps',
                        'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                        'value' => date('Y-m-d'),
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]),
                    'format' => 'html',
                ],
                // 'sgroup.sps_group',
             
                [
                    'attribute' => 'no_sps_42',
                    'label' => 'NO SPS 42',
                    'value' => 'sgroup.sps_group',
                ],
                [
                    'attribute' => 'no_sps_40',
                    'label' => 'NO SPS 40',
                    'value' => 'pekebun.no_sps',
                ],
                // 'pekebun.no_sps',
                [
                    'attribute' => 'modul',
                    'label' => 'Modul',
                    'value' => 'smodul.modul',
                ],                // [
                //     'attribute' => 'no_sps_40',
                //     'label' => 'Pekebun',
                //     'value' => 'pekebun.fullname',
                // ],
                'nama_pekebun',
                // 'admin.fullname',
                // [
                //     'attribute' => 'status',
                //     'label' => 'Status',
                // ]
                'rp',
                'r1',
                'r4',
                [
                    'attribute' => 'status',
                    'label' => 'Status',
                    'format' => 'raw',
                    'filter' => ['0' => 'IN STOCK', '1' => 'DONE','2'=> 'TRANSIT'],
                    'value' => function ($model) {
                        $badge = 'info';
                        $text = 'In Stock';

                        if ($model->status == 1) {
                            $badge = 'success';
                            $text = 'Done';
                        }
                        if ($model->status == 2) {
                            $badge = 'danger';
                            $text = 'transit';
                        }

                        return '<span class="right badge badge-' . $badge . '">' . $text . '</span>';
                    },
                ],
                // [
                //     'label' => '',
                //     'format' => 'raw',
                //     'value' => function ($model) {
                //         return Html::a('<i class="fas fa-edit"></i>', Url::to(['users/view', 'id' => $model->id]), ['class' => 'btn btn-primary btn-xs']);
                //     }
                // ],
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