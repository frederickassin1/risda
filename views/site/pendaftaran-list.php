<?php

use app\models\RefKategori;
use app\models\sukum\RefSukan;
use app\models\TblUsers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\TblUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Pengguna Berdaftar';
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
        <div class="row">
            <div class="col-md-6">

                <?= $model ? "" : Html::a('Kemaskini Pendaftaran', ['site/pendaftaran-awal'], ['class' => 'btn btn-info']) ?>
            </div>
            <div class="col-md-6 text-md-right">
                <?= $model ? '<button type="button" class="btn btn-secondary">Anda Telah Menghantar Borang Pendaftaran</button>'
                    : Html::a('Hantar Pendaftaran', ['site/submit-pendaftaran'], ['class' => 'btn btn-success', 'id' => 'updateRegistration']) ?>
            </div>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-sm table-bordered'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Sukan',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $v = RefKategori::findOne(['id' => $model->kategori_id]);
                        $val = RefSukan::findOne(['id' => $v->sukan_id]);
                        return $val->nama . ' ( ' . $v->kategori . ')';
                    }
                ],

                'status',
                'total',
                [
                    'label' => 'Tambah Atlet',
                    'format' => 'raw',
                    'contentOptions' => ['style' => 'width: 75px;', 'class' => 'text-center'], // Set fixed width for column3

                    'value' => function ($model) {
                        if ($model->status == "VERIFIED") {
                            $v = Html::a('<i class="fas fa-users"></i>', Url::to(['user/add-athlete', 'id' => $model->id]), ['class' => 'btn btn-primary btn-xs']);
                        } else {
                            $v = '';
                        }
                        return $v;
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
<?php
$js = <<<JS
    document.getElementById('updateRegistration').addEventListener('click', function(event) {
        if (!confirm('Anda Pasti Untuk Menghantar Borang Pendaftaran Awal?? Kemaskini Pendaftaran akan Dinyahaktifkan. ')) {
            event.preventDefault(); // Prevent default action (form submission)
        }
    });
JS;
$this->registerJs($js);
?>