<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\sukum\RefSukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Sukan';
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
            <?= Html::a('Tambah Sukan', ['tambah-rekod-sukan'], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'nama',
                //'jenis',
                [
                    'attribute' => 'jenis',
                    'label' => 'Jenis',
                    'format' => 'raw', // Render the output as raw HTML
                    'filter' => [1 => 'Permainan', 2 => 'Olahraga'],
                    'value' => function ($model) {
                        $badge = 'info';
                        $text = 'Permainan';

                        if ($model->jenis === 1) {
                            $badge = 'primary';
                            $text = 'Permainan';
                        }
                        elseif ($model->jenis === 2) {
                            $badge = 'primary';
                            $text = 'Olahraga';
                        }

                        return '<span class="right badge badge-' . $badge . '">' . $text . '</span>';
                    },
                ],
                // [
                //     'label' => 'Kategori',
                //     'attribute' => 'kategoris',
                // ],
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        
    </div>
    
</div>
