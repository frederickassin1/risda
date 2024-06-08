<?php

$this->title = 'Home';
$this->params['breadcrumbs'][] = $this->title;
// var_dump($admin_rp);die;
?>
<div class="container-fluid">

    <!-- <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">
                        10
                        <small>%</small>
                    </span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Likes</span>
                    <span class="info-box-number">41,410</span>
                </div>

            </div>

        </div>


        <div class="clearfix hidden-md-up"></div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Sales</span>
                    <span class="info-box-number">760</span>
                </div>

            </div>

        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">New Members</span>
                    <span class="info-box-number">2,000</span>
                </div>

            </div>

        </div>

    </div> -->

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
                            <!-- <p class="text-center">
                                <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                            </p> -->
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

                        <!-- <div class="col-md-4">
                            <p class="text-center">
                                <strong>Baja Yang Selesai Di Hantar</strong>
                            </p>
                            <div class="progress-group">
                                Add Products to Cart
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                Complete Purchase
                                <span class="float-right"><b>310</b>/400</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                <span class="progress-text">Visit Premium Page</span>
                                <span class="float-right"><b>480</b>/800</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                            </div>

                            <div class="progress-group">
                                Send Inquiries
                                <span class="float-right"><b>250</b>/500</span>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                                </div>
                            </div>

                        </div> -->

                    </div>

                </div>

                <!-- <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                <h5 class="description-header">$35,210.43</h5>
                                <span class="description-text">TOTAL REVENUE</span>
                            </div>

                        </div>

                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                <h5 class="description-header">$10,390.90</h5>
                                <span class="description-text">TOTAL COST</span>
                            </div>

                        </div>

                        <div class="col-sm-3 col-6">
                            <div class="description-block border-right">
                                <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                <h5 class="description-header">$24,813.53</h5>
                                <span class="description-text">TOTAL PROFIT</span>
                            </div>

                        </div>

                        <div class="col-sm-3 col-6">
                            <div class="description-block">
                                <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                                <h5 class="description-header">1200</h5>
                                <span class="description-text">GOAL COMPLETIONS</span>
                            </div>

                        </div>
                    </div>

                </div> -->

            </div>

        </div>

    </div>




</div>