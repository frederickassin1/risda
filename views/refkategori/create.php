<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RefKategori $model */

$this->title = 'Create Ref Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
