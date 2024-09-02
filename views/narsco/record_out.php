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

        <div class="site-tabs">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Rekod</a>
                </li>
 
            </ul>

            <!-- Tab content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div style="font-size: 16px;">
                        <?= $this->render('_out-record', ['model' => $model, 'bil' => $bil]) ?>
                    </div>
                </div>

          
            </div>
        </div>


    </div>
</div>