<?php

/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);

use ruturajmaniyar\widgets\toast\ToastrFlashMessage;
use ruturajmaniyar\widgets\toast\ToastrFlashMessageSession;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Survey</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<style>
    .light {
        opacity: 0.2;
        /* Barely see the text over the background */
    }

    .medium {
        opacity: 0.5;
        /* See the text more clearly over the background */
    }

    .heavy {
        opacity: 0.8;
        /* See the text very clearly over the background */
    }
</style>

<?php

$url = Yii::getAlias("@web") . '/images/';

?>

<body class="hold-transition login-page" style="background-image:url('<?= $url; ?>risda.png');background-repeat:no-repeat; background-position:center; background-size:100%;">
    <?php $this->beginBody() ?>
    <div class="login-box">
        <!-- /.login-logo -->
        <?= ToastrFlashMessageSession::widget(['options' => [
            "closeButton" => true,
            "newestOnTop" => true,
            "progressBar" => true,
            "positionClass" => ToastrFlashMessage::POSITION_TOP_CENTER,
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
    </div>
    <!-- /.login-box -->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>