<?php

use yii\helpers\Html;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
// var_dump($admin_rp);die;
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ringkasan Data </h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-wrench"></i>
                            </button>

                        </div>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-right">
                                <?= Html::a('<i class="fas fa-download"></i>  Muat Turun', ['site/print'], [
                                    'class' => 'btn btn-success btn-sm', // Bootstrap 4+ uses btn-sm for small buttons
                                    'target' => '_blank',
                                    'data' => [
                                        'method' => 'post',
                                    ],
                                ]); ?>
                                </p>
                            <div class="chart">
                                <table class="table table-sm table-bordered jambo_table table-striped">
                                    <thead>
                                        <tr class="headings">
                                            <th style="width:auto; text-align:center;" rowspan="3">BAJA</th>
                                            <th style="width:auto; text-align:center;" rowspan="3">JUMLAH BAJA SPS40 (RISDA)</th>
                                            <th style="width: auto; text-align:center;" rowspan="3">SUDAH BEKAL (FLEET)</th>
                                            <th style="width: auto; text-align:center;" rowspan="3">TRANSIT (FLEET)</th>
                                            <th style="width: auto; text-align:center;" rowspan="3">BELUM BEKAL</th>
                                            <th style="width: auto; text-align:center;" rowspan="3">BAJA DI STOR (NARSCO)</th>

                                        </tr>

                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;">RP</td>
                                            <td style="text-align: center;"><?= $rp ?></td>
                                            <td style="text-align: center;"><?= $f_rp == NULL ? '0' : $f_rp  ?></td>
                                            <td style="text-align: center;"><?= $t_rp == NULL ? '0' : $t_rp ?></td>
                                            <td style="text-align: center;"><?= $rp - ($f_rp + $t_rp) ?></td>
                                            <td style="text-align: center;"><?= $in_stor->rp_baki ?></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">R1</td>
                                            <td style="text-align: center;"><?= $r1 ?></td>
                                            <td style="text-align: center;"><?= $f_r1  == NULL ? '0' : $f_r1 ?></td>
                                            <td style="text-align: center;"><?= $t_r1 == NULL ? '0' : $t_r1 ?></td>
                                            <td style="text-align: center;"><?= $r1 - ($f_r1 + $t_r1) ?></td>
                                            <td style="text-align: center;"><?= $in_stor->r1_baki ?></td>

                                        </tr>
                                        <tr>
                                            <td style="text-align: center;">R4</td>
                                            <td style="text-align: center;"><?= $r4 ?></td>
                                            <td style="text-align: center;"><?= $f_r4  == NULL ? '0' : $f_r4 ?></td>
                                            <td style="text-align: center;"><?= $t_r4 == NULL ? '0' : $t_r4 ?></td>
                                            <td style="text-align: center;"><?= $r4 - ($f_r4 + $t_r4) ?></td>
                                            <td style="text-align: center;"><?= $in_stor->r4_baki ?></td>

                                        </tr>

                                    </tbody>

                                </table>
                            </div>

                        </div>


                    </div>

                </div>


            </div>

        </div>

    </div>




</div>