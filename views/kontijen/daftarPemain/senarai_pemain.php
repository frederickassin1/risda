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
        <h3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
            MAKLUMAT SUKAN</small>
        </h3>
    </div>
    <div class="card-body">
        <?=
        DetailView::widget([
            'model' => $sukan,
            'attributes' => [         
                [                      
                    'label' => 'NAMA SUKAN',
                    'attribute' => 'sukan.fullname',
                ],
                [                      
                    'label' => 'PEMAIN MAKSIMUM (BILANGAN)',
                    'attribute' => 'sukan.yuran',
                ],
                [                      
                    'label' => 'PEMAIN MINIMUM (BILANGAN)',
                    'attribute' => 'sukan.yuran',
                ],
                [                      
                    'label' => 'COACH',
                    'attribute' => 'sukan.yuran',
                ],
            ],
        ]);
        ?>
    </div>
</div>
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-check"></i>&nbsp;
            SENARAI JURULATIH/PENGURUS/JURULATIH<small>
        </h3>
    </div>
    <div class="card-body">
    <p align="left"><?=  Html::a('<i class="fa fa-plus"></i> Tambah Pemain ', ['tambah-pemain','id'=>$sukan->id], ['class' => 'btn btn-success',
        'data-toggle' => "modal",
        'data-target' => "#myModal",
        'data-title' => 'PESERTA',]) ?>
        <?= Html::a('Kembali', ['daftar-pemain'], ['class' => 'btn btn-primary float-right']);?>
    </p>
        <!-- <?= Html::a('<i class="fa fa-plus"> Tambah</i>', ['tambah-pemain','id'=>$sukan->id], ['class' => 'btn btn-success',
        'data-toggle' => "modal",
        'data-target' => "#myModal",
        'data-title' => 'PESERTA',]) ?>
        <?= Html::a('Back', ['daftar-pemain'], ['class' => 'btn btn-primary float-right']) ?> -->
    </br>
    </br>
    <?= GridView::widget([
    'dataProvider' => $pemain,
    'columns' => [
        [
            'label'=>'ICNO',
            'attribute'=>'icno',
           ],
       [
        'label'=>'NAMA PEMAIN',
        'attribute'=>'biodata.nama',
       ],
       [
        'label'=>'JANTINA',
        'attribute'=>'biodata.jantina_',
       ],
       [
        'label'=>'PERANAN',
        'attribute'=>'peranan.peranan',
       ],
    ],
    'emptyText' => 'BELUM ADA PESERTA YANG DIDAFTARKAN.'
]) ?>

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