<?php

use app\models\RefKategori;
use app\models\RefYuran;
use app\models\sukum\TblSukan;
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
    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'sukan',
                'kategori',
                
                // 'kategori',

                [
                    'attribute' => 'status',
                    'filter' => ['1'=>'Dipertandingkan', '0' => 'Tidak dipertandingkan'],
                    'value' =>'statussukan',
                    'format' => 'html',
                ],
                [
                    'attribute' => 'jenis',
                    'filter' => ['1'=>'Individu', '0' => 'Berkumpulan'],
                    'value' =>'jenissukan',
                    'format' => 'html',
                ],
                [
                    'attribute' => 'Yuran',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Yii::$app->formatter->asCurrency($model->yuran, 'RM ');
                    },
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                ],
                'maks',
                'pengurus',
                // [
                //     'class' => ActionColumn::className(),
                //     'urlCreator' => function ($action, TblSukan $model, $key, $index, $column) {
                //         return Url::toRoute([$action, 'id' => $model->id]);
                //     }
                // ],

            ],
            'pager' => [
                'firstPageLabel' => 'Halaman Pertama',
                'lastPageLabel'  => 'Halaman Terakhir'
            ],
        ]); ?>

    </div>

</div>