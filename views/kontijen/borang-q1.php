<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\sukum\TblPendaftaran $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'MAKLUMAT PENDAFTARAN';
?>

<div class="card card-primary card-outline heavy">



    <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><b>Q-1</b>
        </span>
        &nbsp;
        <b>
            KEJOHANAN SUKAN STAF ANTARA UNIVERSITI MALAYSIA (SUKUM)
            KALI KE-45, TAHUN <?= date("Y"); ?><br>
            08 - 17 Ogos 2024</center>
        </b></small>



    </div>
</div>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-list-alt"></i>&nbsp;
            BORANG PENDAFTARAN KUANTITATIF</small>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>



        <div class="form-group">
            <div class="row">
                <label class="control-label col-md-3 col-sm-3 col-xs-4 text-right">IPTA/KONTINJEN: </label>
                <div class="col-md-6 col-sm-6 col-xs-8">
                    <?= $form->field($model, 'created_by')->textInput(['value' => $model->pendaftar->ipta->nama, 'disabled' => true])->label(false); ?>
                </div>
            </div>
        </div>

        <hr>





        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="card card-primary card-outline heavy">
    
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered jambo_table table-striped ">

                <tr class="headings">
                    <th class="column-title text-center" style="background-color:#192841;color:white" ><?= $jaring->nama;?></th>
                    <th class="column-title text-center" style="background-color:#192841;color:white">LELAKI</th>
                    <th class="column-title text-center" style="background-color:#192841;color:white">WANITA</th>

                </tr>

                <tr>
                    <td class="text-left">PENYERTAAN</td>
                    <td class="text-center">*******</td>
                    <td class="text-left" ></td>

                </tr>

                <tr>
                    <td class="text-left">JUMLAH</td>
                    <td class="text-center" >*******</td>
                    <td class="text-center" >/12</td>

                </tr>

                <tr>
                    <td class="text-left">PENGURUS/JURULATIH</td>
                    <td class="text-center" >*******</td>
                    <td class="text-center" >/2</td>

                </tr>

                
             

            </table>
        </div>


        <div class="table-responsive">
            <table class="table table-sm table-bordered jambo_table table-striped ">

                <tr class="headings">
                    <th class="column-title text-center" style="background-color:#192841;color:white" ><?= $tampar->nama;?></th>
                    <th class="column-title text-center" style="background-color:#192841;color:white">LELAKI</th>
                    <th class="column-title text-center" style="background-color:#192841;color:white">WANITA</th>

                </tr>

                <tr>
                    <td class="text-left">PENYERTAAN</td>
                    <td class="text-center"></td>
                    <td class="text-left" ></td>

                </tr>

                <tr>
                    <td class="text-left">JUMLAH</td>
                    <td class="text-center" >*******</td>
                    <td class="text-center" >/12</td>

                </tr>

                <tr>
                    <td class="text-left">PENGURUS/JURULATIH</td>
                    <td class="text-center" >*******</td>
                    <td class="text-center" >/2</td>

                </tr>

                
             

            </table>
        </div>









        <?php ActiveForm::end(); ?>
        <hr>
        Tarikh disahkan oleh: <br>
        Disahkan oleh:
    </div>


</div>
<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user"></i>&nbsp;
            MAKLUMAT PEGAWAI PERHUBUNGAN</small>
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="table-responsive">
            <table class="table table-sm table-bordered jambo_table table-striped ">

                <tr class="headings">
                    <th class="column-title text-center" style="background-color:#192841;color:white" colspan="4">MAKLUMAT PEGAWAI PERHUBUNGAN</th>

                </tr>

                <tr>
                    <td class="text-left">NAMA</td>
                    <td class="text-left" colspan="3"><?= $model->pendaftar->fullname ?></td>

                </tr>

                <tr>
                    <td class="text-left">JAWATAN</td>
                    <td class="text-left" colspan="3"></td>

                </tr>

                <tr>
                    <td class="text-left">TEL. PEJABAT</td>
                    <td class="text-left"><?= $model->pendaftar->fullname ?></td>
                    <td class="text-left">TEL. BIMBIT</td>
                    <td class="text-left"><?= $model->pendaftar->fullname ?></td>

                </tr>

                <tr>
                    <td class="text-left">FAKS</td>
                    <td class="text-left"><?= $model->pendaftar->fullname ?></td>
                    <td class="text-left">EMAIL</td>
                    <td class="text-left"><?= $model->pendaftar->fullname ?></td>

                </tr>
                <tr>
                    <td class="text-left">ALAMAT</td>
                    <td class="text-left" colspan="3"></td>

                </tr>

            </table>
        </div>









        <?php ActiveForm::end(); ?>
        <hr>
        Tarikh disahkan oleh: <br>
        Disahkan oleh:
    </div>


</div>

<hr>

