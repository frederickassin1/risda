<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblUsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Senarai Rekod';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
            'action' => ['record-list'],
            'method' => 'get',
        ]); ?>
        <div class="form-group ">

            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <?= DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'tarikh_sps',
                        'options' => ['placeholder' => 'Tarikh SPS'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd', // Adjust the date format as needed
                        ]
                    ]); ?>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <?= Html::activeTextInput($searchModel, 'modul', ['class' => 'form-control', 'placeholder' => 'MODUL']) ?>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <?=
                    $form->field($searchModel, 'status')->label(false)->widget(Select2::classname(), [
                        'data' => ['0' => 'IN STOCK', '1' => 'DONE', '2' => 'TRANSIT'],
                        'options' => ['placeholder' => 'Status', 'class' => 'form-control col-md-2 col-xs-12'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?> </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <?= Html::activeTextInput($searchModel, 'no_sps_42', ['class' => 'form-control', 'placeholder' => 'NO SPS42']) ?>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <?= Html::activeTextInput($searchModel, 'no_sps_40', ['class' => 'form-control', 'placeholder' => 'NO SPS40']) ?>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <?= Html::activeTextInput($searchModel, 'nama', ['class' => 'form-control', 'placeholder' => 'Pekebun']) ?>
                </div>

            </div>
            <div class="col-12 col-md-2 mb-3">
                <?= Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn btn-outline-secondary btn-block']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

