<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblUsers $model */

$this->title = 'Kemaskini Profil Pengguna ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Pengguna Berdaftar', 'url' => ['admin/user-list']];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;<strong><?= Html::encode($this->title) ?></strong></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
<script>
    window.onload = function() {
        document.getElementById('user-current_password').value = '';
        document.getElementById('user-password').value = '';
        document.getElementById('user-password_repeat').value = '';
    };
</script>