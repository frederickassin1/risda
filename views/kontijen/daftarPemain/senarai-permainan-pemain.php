<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\bootstrap4\Modal;

$this->title = 'SENARAI PEMAIN';
Modal::begin([
    'id' => 'myModal',
    'title' => '<h4></h4>',
    'size' => 'modal-lg'
]);

Modal::end();
?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chess"></i>&nbsp;
            SENARAI PERMAINAN YANG DIPERTANDINGKAN<small>
        </h3>
    </div>
    <div class="card-body">
    <p align="left"><?=  Html::a('<i class="fa fa-plus"></i> Tambah Permainan ', ['tambah-permainan','id'=>$id], ['class' => 'btn btn-success',
        'data-toggle' => "modal",
        'data-target' => "#myModal",
        'data-title' => 'PESERTA',]) ?>
        <?= Html::a('Kembali', ['index-peserta'], ['class' => 'btn btn-primary float-right']);?>
    </p>
        <!-- <?= Html::a('<i class="fa fa-plus"> Tambah</i>', ['tambah-pemain','id'=>$sukan->id], ['class' => 'btn btn-success',
        'data-toggle' => "modal",
        'data-target' => "#myModal",
        'data-title' => 'PESERTA',]) ?>
        <?= Html::a('KEMBALI', ['index-peserta'], ['class' => 'btn btn-primary float-right']) ?> -->
    </br>
    </br>
    <?= GridView::widget([
                'dataProvider' => $pemain,
                // 'filterModel' => $searchModel,

                'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'PERMAINAN YANG DIPERTANDINGKAN',
                        'attribute' => 'listsukan_id',
                        'value' => function ($data) {
                            return $data->listSukan->sukan->sukan;
                        },
                    ],
                    [
                        'label' => 'PERANAN',
                        'attribute' => 'role',
                        'value' => function ($data) {
                            return $data->peranan->peranan;
                        },
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'label' => 'MAKLUMAT PERMAINAN',
                        'value' => function ($model) {
                            return Html::a('<i class="fa fa-plus-square" aria-hidden="true"></i>', [
                                'maklumat-permainan',

                                'id' => $model->listSukan->sukan->id,
                            ], [
                                
                                'class' => 'btn btn-info btn-xs mapBtn',
                                //                                        'target' => '_blank',
                            ]);
                        },
                        'format' => 'raw',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 15%;'],

                    ],
                    

                  
                ],
            ]); ?>

    </div>
</div>

<?php
$this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");

?>