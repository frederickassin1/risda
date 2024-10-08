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
<style>
    .uppercase {
        text-transform: uppercase;
    }
</style>
<div class="card card-primary card-outline heavy uppercase">
<?= $this->render('/_search',['searchModel'=>$searchModel]) ?>

    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<?= Html::encode($this->title) ?></small></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Tarikh Selesai Bekal',
                    'value' => 'fleet.tarikh_keluar',
                ],  
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
                ],                // 'sgroup.sps_group',
             
                [
                    'attribute' => 'no_sps_42',
                    'label' => 'No SPS 42',
                    'value' => 'sgroup.sps_group',
                ],
                [
                    'attribute' => 'no_sps_40',
                    'label' => 'No SPS 40',
                    'value' => 'pekebun.no_sps',
                ],
                [
                    'attribute' => 'modul',
                    'label' => 'Modul',
                    'value' => 'smodul.modul',
                ],
                // 'smodul.modul',
                [
                    'attribute' => 'nama',
                    'label' => 'Pekebun',
                    'value' => 'pekebun.fullname',
                ],                // 'nama_pekebun',

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
                [
                    'label' => 'Tindakan',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a('<i class="fas fa-edit"></i>', Url::to(['fleet/update', 'id' => $model->id]), ['class' => 'btn btn-primary btn-xs']);
                    }
                ]
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