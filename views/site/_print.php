<?php

use yii\helpers\Html;

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ringkasan Data</h5>
                </div>
        
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align:center;">BAJA</th>
                                <th style="text-align:center;">JUMLAH BAJA SPS40 (RISDA)</th>
                                <th style="text-align:center;">SUDAH BEKAL (FLEET)</th>
                                <th style="text-align:center;">TRANSIT (FLEET)</th>
                                <th style="text-align:center;">BELUM BEKAL</th>
                                <th style="text-align:center;">BAJA DI STOR (NARSCO)</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr>
                                <td style="text-align: center;">RP</td>
                                <td style="text-align: center;"><?= Html::encode($rp) ?></td>
                                <td style="text-align: center;"><?= Html::encode($f_rp == NULL ? '0' : $f_rp) ?></td>
                                <td style="text-align: center;"><?= Html::encode($t_rp == NULL ? '0' : $t_rp) ?></td>
                                <td style="text-align: center;"><?= Html::encode($rp - ($f_rp + $t_rp)) ?></td>
                                <td style="text-align: center;"><?= Html::encode($in_stor->rp_baki) ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">R1</td>
                                <td style="text-align: center;"><?= Html::encode($r1) ?></td>
                                <td style="text-align: center;"><?= Html::encode($f_r1 == NULL ? '0' : $f_r1) ?></td>
                                <td style="text-align: center;"><?= Html::encode($t_r1 == NULL ? '0' : $t_r1) ?></td>
                                <td style="text-align: center;"><?= Html::encode($r1 - ($f_r1 + $t_r1)) ?></td>
                                <td style="text-align: center;"><?= Html::encode($in_stor->r1_baki) ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">R4</td>
                                <td style="text-align: center;"><?= Html::encode($r4) ?></td>
                                <td style="text-align: center;"><?= Html::encode($f_r4 == NULL ? '0' : $f_r4) ?></td>
                                <td style="text-align: center;"><?= Html::encode($t_r4 == NULL ? '0' : $t_r4) ?></td>
                                <td style="text-align: center;"><?= Html::encode($r4 - ($f_r4 + $t_r4)) ?></td>
                                <td style="text-align: center;"><?= Html::encode($in_stor->r4_baki) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
