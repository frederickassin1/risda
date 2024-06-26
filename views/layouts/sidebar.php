<?php

use app\models\sukum\TblPendaftaran;
use app\models\TblUsers;
use yii\helpers\Html;

$user = Yii::$app->user->identity; // Getting user id

$model = TblUsers::find()->where(['id' => $user->id])->one();
error_reporting(0);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="opacity: .9;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <?php //echo Html::img('@web/images/ums-logo-white.png', ['class' => 'brand-image', 'style' => 'width:100px']); 
        ?>
        <span class="brand-text">Supply Monitoring System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="<?php //echo Yii::$app->params['photoDir'] . Yii::$app->user->identity->hashGambar; 
                            ?>" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info">
                <a href="#" class="d-block"><?php //echo strtoupper(Yii::$app->user->identity->AdUser); 
                                            ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Laman Utama',
                        'icon' => 'home',
                        'url' => ['site/index'],
                    ],
               
                 

                ],
            ]);

            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>