<?php

use app\models\RefKategori;
use app\models\RefYuran;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\RefKategoriSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Kategori';
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
            <?= Html::a('Tambah Kategori', ['tambah-kategori'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'sukan.nama',
                'kategori',

                [
                    'label' => 'Ditambah Oleh',
                    'attribute' => 'Added By',
                    // 'format' => 'raw',
                    'value' => 'user.fullname'
                ],
                [
                    'attribute' => 'Status',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->status == 1 ? '<span class="badge badge-warning">Dipertandingkan' : '<span class="badge badge-warning">Tidak Dipertandingkan';
                    },

                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                // [
                //     'attribute' => 'Yuran',
                //     'format' => 'raw',
                //     'value' => function ($model) {
                //         return Yii::$app->formatter->asCurrency($model->yuran, 'RM ');
                //     },
                //     'headerOptions' => ['class' => 'text-center'],
                //     'contentOptions' => ['class' => 'text-center'],
                // ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, RefKategori $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],

            ],
            'pager' => [
                'firstPageLabel' => 'Halaman Pertama',
                'lastPageLabel'  => 'Halaman Terakhir'
            ],
        ]); ?>

    </div>

</div>