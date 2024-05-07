<?php

use kartik\grid\GridView;

?>

<!-- <h4 class="text-center"><strong>_____________________________________________________________ </strong></h4> -->
<br>
<br>
<br>
<html>

<head>
    <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;

        }
    </script>
</head>

<body>
    <div class="text-center" id="div1">
        <centre><img src="../images/ums-logo-black.png" style="width: 25%" /></centre>
        <br>
        <br>
        <!-- </div> -->
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
                            'columns' => [
                                [
                                    'class' => 'kartik\grid\SerialColumn',
                                ],


                                [
                                    'label' => 'SUKAN',
                                    'value' => 'sukan',
                                    'format' => 'text',
                                    'group' => true,
                                ],
                                [
                                    'label' => 'ACARA',
                                    'attribute' => 'kategori',
                                    'format' => 'text',
                                    'group' => true,
                                    'subGroupOf' => 1,
                                ],
                                [
                                    'label' => 'YURAN PESERTA / ACARA',
                                    'attribute' => 'yuran',
                                    'format' => 'text',
                                ],
                                [
                                    'label' => 'BIL PESERTA',
                                    'attribute' => 'total',
                                    'format' => 'text',
                                ],
                                [
                                    'label' => 'JUMLAH(RM) ',
                                    'attribute' => 'JUMLAH',
                                    'format' => 'text',
                                ],
                                [
                                    'label' => 'JUMLAH BESAR (RM) ',
                                    'attribute' => 'JUMLAH_BESAR',
                                    'format' => 'text',
                                    'group' => true,
                                    'subGroupOf' => 1,
                                ],

                            ]
                        ]);
                        ?>
                    </div>

                </div>

            </div>
            <button onclick="printContent('div1')"><a class="btn btn-primary btn-sm">Cetak</a></a>
</body>

</html>
</div>
</div>