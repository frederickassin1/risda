<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RefKategori $model */

$this->title = 'Kemaskini Sukan: ';

// $this->params['breadcrumbs'][] = 'Update';
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
    <div class="col-md-12 col-sm-12 col-xs-6">
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-undo"></i>&nbsp;Kembali', ['index'], ['class' => 'btn btn-default']) ?>
        </p>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div> 
    </div>
    
</div>