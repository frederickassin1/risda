<?php

use app\models\Ref_Kategori;
use app\models\RefKategori;
use app\models\sport\Tblconfirmationform;
use app\models\sport\Tblmain;
use app\models\sukum\ListSukan;
use app\models\sukum\TblSukan;
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
error_reporting(0);
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); 
?>
<!-- register sukan mana yg mau di join -->
<p align="right">
        <?= Html::a('Kembali', ['pendaftaran-awal'], ['class' => 'btn btn-primary']) ?>
</p>


<div class="col-md-12">

    <div class="card card-primary card-outline heavy">



        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-chess"></i>
            </span>
            &nbsp;
            <b>
                KEJOHANAN SUKAN STAF ANTARA UNIVERSITI MALAYSIA (SUKUM)
                KALI KE-45, TAHUN <?= date("Y"); ?><br>
                08 - 17 Ogos 2024</center>
            </b></small>



        </div>
    </div>
</div>
<?php
  echo Html::a(Yii::t('app','<i class="fa fa-address-card"></i> <span class="label label-info">DAFTAR PERMAINAN</span>'), ['pendaftaran-awal'], ['class' => 'btn btn-primary btn-md']);


?>
&nbsp;
<?php
  echo Html::a(Yii::t('app','<i class="fa fa-chess-knight"></i> <span class="label label-info">DAFTAR OLAHRAGA dan CATUR</span>'), ['pendaftaran-awal-olahraga'], ['class' => 'btn btn-success btn-md']);

?>
<br/>
<br/>
<div class="col-md-12">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pendaftaran Awal Kejohanan Permainan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>


        <div class="card-body">

            <table class="table table-bordered table-condensed ">
                <thead>
                    <tr class="headings">
                        <th style="vertical-align : middle;text-align:center;" width="5%" rowspan="2" class="column-title text-center">BIL</th>
                        <th style="vertical-align : middle;text-align:center;" rowspan="2" class="column-title text-left">KATEGORI</th>
                        <th style="vertical-align : middle;text-align:center;" rowspan="2" class="column-title text-left">YURAN (RM)</th>

                        <th class="column-title text-center">PENYERTAAN</th>
                    </tr>

                </thead>
               
                <?php foreach ($list2 as $lists) { ?>
                    <!-- $bil = 71; -->


                    <?php foreach (TblSukan::find()->where(['id' => $lists->id])->andWhere(['status' => 2])->all() as $cat) { ?>
                        <tr>
                            <td class="text-left"><?= $bil++ ?></td>
                            <td class="text-left"> <?= $lists->sukan . ' -' . $cat->kategori ?></td>
                            <td class="text-left"> <?= Yii::$app->formatter->asCurrency($lists->yuran,'RM'); ?></td>

                            <td class="text-center" style="text-align:center" colspan="4"><input type="text" name='ListSukan[id][<?= $cat->id ?>]' value=<?= ListSukan::check($cat->id); ?> class="text-center"></td>

                        </tr>
                    <?php } ?>


                <?php } ?>
            </table>

            <!-- /.card-body -->

            <div class="card-footer">
                <div style="float:right">
                    <?= Html::resetButton('<span class="fa fa-repeat"></span>&nbsp;Reset', ['class' => 'btn btn-danger', 'name' => 'reset-button']) ?>
                    <?= Html::submitButton(Yii::t('app', '<i class="fa fa-save"></i>&nbsp;Simpan'), ['class' => 'btn btn-warning', 'name' => 'simpan', 'value' => 'submit_1']) ?>

                    <?= Html::submitButton('<i class="fa fa-arrow-right"></i>&nbsp;Daftar', ['class' => 'btn btn-primary', 'name' => 'hantar', 'value' => 'submit_2', 'data' => [
                        'disabled-text' => 'Please Wait..',
                        'confirm' => 'ANDA PASTI? JIKA YA, KLIK DAFTAR.'
                    ]]) ?>

                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>