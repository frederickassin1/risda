<?php

use app\models\Ref_Kategori;
use app\models\RefKategori;
use app\models\RefYuran;
use app\models\sport\Tblconfirmationform;
use app\models\sport\Tblmain;
use app\models\TblPenyertaan;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\sport\TbleventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$addon = <<< HTML
<span class="input-group-text">
    <i class="fas fa-calendar-alt"></i>
</span>
HTML;
$this->title = 'Tetapan Yuran';
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); 
?>
<!-- register sukan mana yg mau di join -->
<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $this->title ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>


        <div class="card-body">

            <table class="table table-bordered table-condensed ">
                <thead>
                    <tr class="headings">
                        <th style="vertical-align : middle;text-align:center;background-color:grey" width="5%" class="column-title text-center">Bil</th>
                        <th style="vertical-align : middle;text-align:center;background-color:grey" class="column-title text-left">Permainan</th>
                        <th style="vertical-align : middle;text-align:center;background-color:grey" class="column-title text-center">Yuran(RM)</th>
                    </tr>

                </thead>
                <?php foreach ($list as $list) { ?>
                    <tr>

                        <td style="background-color:white" class="text-center"><b><?= $bil++ ?></b></td>
                        <td style="background-color:white" class="text-left"><b><?= $list->kategori ?></b></td>
                        <td class="text-center" style="text-align:center"><input type="text" name='RefYuran[id][<?= $list->id ?>]' value=<?= RefYuran::check($list->id); ?> class="text-center"></td>


                    </tr>
                <?php } ?>

            </table>

            <!-- /.card-body -->

            <div class="card-footer">
                <div style="float:right">
                    <?= Html::resetButton('<span class="fa fa-repeat"></span>&nbsp;Reset', ['class' => 'btn btn-danger', 'name' => 'reset-button']) ?>
                    <?= Html::submitButton('<i class="fa fa-arrow-right"></i>&nbsp;Submit', ['class' => 'btn btn-primary', 'data' => ['disabled-text' => 'Please Wait..']]) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>