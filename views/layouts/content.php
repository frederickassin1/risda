<?php
/* @var $content string */

use ruturajmaniyar\widgets\toast\ToastrFlashMessage;
use yii\bootstrap4\Breadcrumbs;
use ruturajmaniyar\widgets\toast\ToastrFlashMessageSession;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

$url = Yii::getAlias("@web") . '/images/';


?>
<div class="content-wrapper" style="background-image:url('<?= $url; ?>risda.png');background-repeat:initial; background-position:center; background-size:cover;">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= ToastrFlashMessageSession::widget(['options' => [
            "closeButton" => true,
            "newestOnTop" => true,
            "progressBar" => true,
            "positionClass" => ToastrFlashMessage::POSITION_TOP_RIGHT,
            "showDuration" => "5000",
            "hideDuration" => "5000",
            "timeOut" => "5000",
            "extendedTimeOut" => "5000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "closeEasing" => "linear",
            "showMethod" => "slideDown",
            "hideMethod" => "slideUp",
            "closeMethod" => "slideUp"
        ]]);
        ?>
        <?= $content ?>


        <?php
        // Begin Modal
        Modal::begin([
            'title' => 'Modal Title',
            'id' => 'modal',
            'size' => Modal::SIZE_LARGE,
            'footer' => '
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        ' . Html::button('Mula Penilaian', ['class' => 'btn btn-primary', 'id' => 'startEvaluationButton']) . '
    ',
        ]);

        echo "<div id='modalContent'></div>";

        Modal::end();
        // End Modal
        ?>


        <?php

        $this->registerJs("
            $(function() {
                $(document).on('click', '.modalClassButton', function() {
                    var url = $(this).data('url');

                    $.get(url, function(data) {
                        var response = JSON.parse(data);
                        
                        $('#modal').find('.modal-title').html(response.title);
                        $('#modal').find('#modalContent').html(response.content);
                        $('#modal').find('.modal-footer').html(response.footer);

                        $('#modal').modal('show');
                    });
                });
            });
        ");

        ?>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>