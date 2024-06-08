<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<div class="card card-primary card-outline heavy">
    
    <div class="card-body">
        <p>
            <?= Html::a('<i class="fas fa-plus"></i>&nbsp;Tambah Rekod', ['narsco/add-records'], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="x_panel">
            <div class="x_title" style="color:#37393b;">
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <div class="tblprcobiodata-index">
                        <table class="table table-sm table-bordered jambo_table table-striped">
                            <thead>
                                <tr class="headings">
                                    <th style="width:auto; text-align:center;" rowspan="3">Bil</th>
                                    <th style="width:auto; text-align:center;" rowspan="3">NO SPS 40</th>
                                    <th style="width: auto; text-align:center;" rowspan="3">Tarikh Masuk</th>
                                    <th style="width: auto; text-align:center;" rowspan="3">Tarikh Keluar</th>
                                    <th style="width: auto; text-align:center;" rowspan="3">RP</th>
                                    <th style="width: auto; text-align:center;" rowspan="3">R1</th>
                                    <th style="width: auto; text-align:center;" rowspan="3">R4</th>
                                    <!-- <th style="width: auto; text-align:center;" colspan="9">KELUAR & MASUK STOR KENINGAU</th> -->
                                </tr>
                                <!-- <tr class="headings">
                                    <th style="width: auto; text-align:center;" colspan="3">RP</th>
                                    <th style="width: auto; text-align:center;" colspan="3">R1</th>
                                    <th style="width: auto; text-align:center;" colspan="3">R4</th>
                                </tr>
                                <tr class="headings">
                                    <th style="width: auto; text-align:center;" colspan="1">MASUK</th>
                                    <th style="width: auto; text-align:center;" colspan="1">KELUAR</th>
                                    <th style="width: auto; text-align:center;" colspan="1">BAKI</th>
                                    <th style="width: auto; text-align:center;" colspan="1">MASUK</th>
                                    <th style="width: auto; text-align:center;" colspan="1">KELUAR</th>
                                    <th style="width: auto; text-align:center;" colspan="1">BAKI</th>
                                    <th style="width: auto; text-align:center;" colspan="1">MASUK</th>
                                    <th style="width: auto; text-align:center;" colspan="1">KELUAR</th>
                                    <th style="width: auto; text-align:center;" colspan="1">BAKI</th>
                                </tr> -->
                            </thead>

                            <?php if (!empty($model)): ?>
                                <?php foreach ($model->getModels() as $data): ?>
                                    <tr>
                                        <td><?php if (Yii::$app->getRequest()->getQueryParam('page') > 1) {
                                                echo (Yii::$app->getRequest()->getQueryParam('page') - 1) * 20 + $bil++;
                                            } else {
                                                echo $bil++;
                                            } ?></td>
                                        <td><?= $data->pekebun->no_sps ?></td>
                                        <td></td>
                                        <td><?= $data->tarikh_keluar ?></td>
                                        <td><?= $data->rp ?></td>
                                        <td><?= $data->r1 ?></td>
                                        <td><?= $data->r4 ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="text-center">
                                    <td colspan="9">No Data.</td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
                <?php
                echo LinkPager::widget([
                    'pagination' => $model->pagination,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
