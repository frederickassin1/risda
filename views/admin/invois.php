<?php

use kartik\grid\GridView;
error_reporting(0);
?>

<!-- <h4 class="text-center"><strong>_____________________________________________________________ </strong></h4> -->
<br>
<br>
<br>

<div class="text-center">
    <img src="../images/ums-logo-black.png" style="width: 25%" />
    <br>
    <br>
</div>
<div class="card card-primary card-outline heavy">
    <h4 class="text-center"><strong>KEJOHANAN SUKAN STAF ANTARA UNIVERSITI MALAYSIA (SUKUM)<br>KALI KE-45 TAHUN 2024</strong></h4>
    <!-- <h4 class="text-center"><strong>_____________________________________________________________ </strong></h4> -->
    <div class="x_panel">
        <h4 align="right"><strong>INVOIS</strong></h4>
        <p><strong>NAMA UNIVERSITI : </strong><strong><?php echo $ipta->nama; ?></strong> </p>


        <div class="x_content">
            <div class="table-responsive">

                <?=
                GridView::widget([
                    'dataProvider' => $model,
                    'summary' => false,
                    'columns' => [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                        ],


                        [
                            'label' => 'SUKAN',
                            'value' => 'sukan.sukan',
                            'format' => 'raw',
                            'group' => true,
                        ],
                        [
                            'label' => 'ACARA',
                            'value' => function($model){
                                if($model->sukan->sukan == 'YURAN PENYERTAAN'){
                                    return '';
                                }else{
                                    return $model->sukan->kategori;
                                }
                            },
                            'format' => 'text',
                            'group' => true,
                            'subGroupOf' => 1,
                        ],
                        [
                            'label' => 'YURAN PESERTA / ACARA',
                            'value' => function($model){
                                if($model->sukan->id == '131'){
                                    return '';
                                }else{
                                    return Yii::$app->formatter->asCurrency($model->sukan->yuran, 'RM ');
                                }
                            },
                            'format' => 'text',
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'label' => 'BIL PESERTA',
                            'value' => function($model){
                                if($model->sukan->id == '131'){
                                    return '';
                                }else{
                                    return $model->total;
                                }
                            },
                            'format' => 'text',
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'label' => 'JUMLAH(RM) ',
                            'attribute' => 'total',
                            'format' => 'text',
                        ],
                        [
                            'label' => 'JUMLAH BESAR (RM) ',
                            'attribute' => 'total',
                            'format' => 'text',
                        ],

                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>