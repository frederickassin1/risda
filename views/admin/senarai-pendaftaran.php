<?php

use app\models\sukum\TblPendaftaran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Pendaftaran Keseluruhan SUKUM';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
            <?= Html::encode($this->title) ?></small>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Nama Pendaftar',
                    'attribute' => 'created_by',
                    'value' => function ($data) {
                        return $data->pendaftar->fullname;
                    },
                ],
                [
                    'label' => 'IPTA/Kontinjen',
                    'attribute' => 'ipta_id',
                    'value' => function ($data) {
                        return $data->pendaftar->ipta->nama;
                    },
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center'],
                ],
                [
                    'label' => 'STATUS',
                    'value' => function ($data) {
                        if($data->status == 0)
                        {
                        return  '<span class="badge badge-primary">'.$data->statuss->status.'</span>';
                        }
                        elseif($data->status == 1)
                        {
                            return  '<span class="badge badge-warning">'.$data->statuss->status.'</span>';

                        }
                        elseif($data->status == 2)
                        {
                            return  '<span class="badge badge-info">'.$data->statuss->status.'</span>';

                        }
                        elseif($data->status == 3)
                        {
                            return  '<span class="badge badge-default">'.$data->statuss->status.'</span>';

                        }                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center'],
                ],
                [
                    'label' => 'Pengesahan Borang',
                    'headerOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {

                        return
                            Html::a('<i class="fas fa-edit"></i>', ['pengesahan-pendaftaran', 'id' => $model->id], ['class' => 'mapBtn btn btn-default btn-sm']);

                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'label' => 'Jana Invois',
                    'headerOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {

                        return
                            Html::a('<i class="fas fa-print"></i>', ['invois', 'ipta_id' => $model->pendaftar->ipta_id], ['class' => 'mapBtn btn btn-default btn-sm',  'target' => "blank"]);

                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                ],
            ],
        ]); ?>
    </div>
    <ul>
    <li><span class="badge badge-primary"> DRAF</span> : Belum Daftar & Masih Boleh Dikemaskini</li>
    <li><span class="badge badge-warning">TELAH DAFTAR</span> : Pendaftaran awal telah daftar & Menunggu Tindakan Urusetia</li>
    <li><span class="badge badge-info">DISAHKAN</span> : Pembayaran Penyertaan Telah Disahkan<br></li>
    <li><span class="badge badge-success">SELESAI</span> : Penyertaan Kontijen Selesai</li>
</ul>
</div>