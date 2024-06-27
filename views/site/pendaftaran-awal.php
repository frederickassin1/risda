<?php

use app\models\Ref_Kategori;
use app\models\RefKategori;
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
$this->title = 'Pendaftaran Awal Kejohanan';
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); 
?>
<!-- register sukan mana yg mau di join -->
<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pendaftaran Awal Kejohanan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>


        <div class="card-body">

            <table class="table table-bordered table-condensed ">
                <thead>
                    <tr class="headings">
                        <th style="vertical-align : middle;text-align:center;" width="5%" rowspan="2" class="column-title text-center">Bil</th>
                        <th style="vertical-align : middle;text-align:center;" rowspan="2" class="column-title text-left">Permainan</th>
                        <th class="column-title text-center">Penyertaan</th>
                    </tr>

                </thead>
                <?php foreach ($list as $list) { ?>


                    <td style="background-color:grey" class="text-center"><b><?= $bil++ ?></b></td>
                    <td colspan="4" style="background-color:grey" class="text-left"><b><?= $list->nama ?></b></td>

                    <?php foreach (RefKategori::find()->where(['sukan_id' => $list->id])->andWhere(['status' => 1])->all() as $cat) { ?>
                        <tr>
                            <td class="text-left"></td>
                            <td class="text-left">(<?= $bil2++ ?>) <?= $cat->kategori ?></td>
                            <td class="text-center" style="text-align:center"><input type="checkbox" name='TblPenyertaan[id][<?= $cat->id ?>]' value="1" class="checkId" <?= TblPenyertaan::check($cat->id) == 1 ? 'checked' : '' ?>></td>

                        </tr>
                    <?php } ?>


                <?php } ?>
                <?php foreach ($list2 as $lists) { ?>


                    <td style="background-color:grey" class="text-center"><b><?= $bil++ ?></b></td>
                    <td colspan="4" style="background-color:grey" class="text-left"><b><?= $lists->nama ?></b></td>

                    <?php foreach (RefKategori::find()->where(['sukan_id' => $lists->id])->andWhere(['status' => 1])->all() as $cat) { ?>
                        <tr>
                            <td class="text-left"></td>
                            <td class="text-left">(<?= $bil2++ ?>) <?= $cat->kategori ?></td>
                            <td class="text-center" style="text-align:center"><input type="text" name='TblPenyertaan[id][<?= $cat->id ?>]' value=<?= TblPenyertaan::check($cat->id); ?> class="text-center"></td>

                        </tr>
                    <?php } ?>


                <?php } ?>
            </table>

            <!-- /.card-body -->

            <div class="card-footer">
                <div style = "float:right" >
                    <?= Html::resetButton('<span class="fa fa-repeat"></span>&nbsp;Reset', ['class' => 'btn btn-danger', 'name' => 'reset-button']) ?>
                    <?= Html::submitButton('<i class="fa fa-arrow-right"></i>&nbsp;Submit', ['class' => 'btn btn-primary', 'data' => ['disabled-text' => 'Please Wait..']]) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
   
    </div>
</div>