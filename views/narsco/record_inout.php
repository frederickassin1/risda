<?php

use yii\helpers\Html;

use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\TblUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$bil = 1;
$this->title = 'Senarai Rekod';
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

    <div style="font-size: 16px;">
                    <?= $this->render('_inout_record', ['model2' => $model2, 'bil' => $bil]) ?>
                    </div>
                </div>
          

    </div>
</div>