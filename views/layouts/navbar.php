<?php

use yii\helpers\Html;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= \yii\helpers\Url::home() ?>" class="nav-link"><i class="fas fa-home"></i></a>
        </li>
        <!-- <li class="nav-item">
            <?= Html::a('Hubungi Kami', ['/site/contact-us'], ['class' => 'nav-link']) ?>
        </li> -->
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <?php echo strtoupper(Yii::$app->user->identity->fullname); ?>&nbsp;&nbsp;<i class="fas fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <?= Html::a(
                    '<i class="fas fa-user"></i>&nbsp;Profil',
                    ['/site/personal'],
                    ['class' => 'dropdown-item']
                )
                ?>
                <?= Html::a(
                    '<i class="fas fa-key"></i>&nbsp;Tukar Kata Laluan',
                    ['/users/change-password'],
                    ['class' => 'dropdown-item']
                )
                ?>
                <?= Html::a(
                    '<i class="fas fa-sign-out-alt"></i>&nbsp;Log Keluar',
                    ['/site/logout'],
                    ['data-method' => 'post', 'class' => 'dropdown-item']
                )
                ?>
            </div>
        </li>



        <!-- <li class="nav-item">
            <?php //echo Html::a('<i class="fas fa-sign-out-alt"></i>&nbsp;Log Keluar', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->