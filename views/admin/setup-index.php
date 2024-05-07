<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use app\models\sport\Tblevents;
use app\models\sport\Tblmain;
use app\models\sport\Tblsportsdetails;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SesiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Senarai Tetapan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-olive">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></small></h3>

    </div>


    <div class="card-body ">
        <?= Html::a('Tetapan', ['admin/setup'], [
            'class' => 'btn btn-primary float-right',
            'title' => 'Tetapan',
            'data-pjax' => 0,
        ]);
        ?>
<br>
        <?php

        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'user.email',
            'created_dt',

            [
                'attribute' => 'Jenis',
                'value' => 'types',
            ],
            [
                'attribute' => 'status',
                'value' => 'statuss',
            ],

        ];

        ?>

        <?php

        echo GridView::widget([
            'id' => 'kv-grid-demo',
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => $gridColumns, // check this value by clicking GRID COLUMNS SETUP button at top of the page
            'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
            'floatHeader' => true, // table header floats when you scroll
            'floatPageSummary' => false, // table page summary floats when you scroll
            'floatFooter' => false, // disable floating of table footer
            'pjax' => false, // pjax is set to always false for this demo
            // parameters from the demo form
            'responsive' => false,
            'bordered' => true,
            'striped' => false,
            'condensed' => true,
            'hover' => true,
            'showPageSummary' => false,
            'panel' => [
                // 'after' => '<div class="float-right float-end"><button type="button" class="btn btn-primary" onclick="var keys = $("#kv-grid-demo").yiiGridView("getSelectedRows").length; alert(keys > 0 ? "Downloaded " + keys + " selected books to your account." : "No rows selected for download.");"><i class="fas fa-download"></i> Download Selected</button></div><div style="padding-top: 5px;"><em>* The page summary displays SUM for first 3 amount columns and AVG for the last.</em></div><div class="clearfix"></div>',
                // 'heading' => '<i class="fas fa-book"></i>  Library',
                // 'type' => 'default',
            ],
            // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'exportConfig' => [
                'html' => [],
                'csv' => [],
                'txt' => [],
                'xls' => [],
                // 'pdf' => [],
                'json' => [],
            ],
            // set your toolbar
            // 'toolbar' =>  [
            //     [
            //         'content' =>
            //         Html::a('<i class="fas fa-plus"></i>&nbsp;Tetapan', ['admin/setup'], [
            //             'class' => 'btn btn-success',
            //             'title' => 'Tetapan',
            //             'data-pjax' => 0,
            //         ]), 

            //         'options' => ['class' => 'btn-group mr-2 me-2']
            //     ],
            //     '{export}',
            //     '{toggleData}',
            // ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
            'itemLabelSingle' => 'Record',
            'itemLabelPlural' => 'Records'
        ]);
        ?>

    </div>
</div>