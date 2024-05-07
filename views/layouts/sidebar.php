<?php

use app\models\sukum\TblPendaftaran;
use app\models\TblUsers;
use yii\helpers\Html;
$user = Yii::$app->user->identity; // Getting user id

$model = TblUsers::find()->where(['id' => $user->id])->one();
$daftar = TblPendaftaran::find()->where(['created_by' => $user->id])->one();
error_reporting(0);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="opacity: .9;">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
        <?php echo Html::img('@web/images/ums-logo-white.png', ['class' => 'brand-image', 'style' => 'width:100px']); ?>
        <span class="brand-text">SUKUM 2024</span>
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
                    [
                        'label' => 'Admin',
                        'icon' => 'users-cog',
                        'visible' => (Yii::$app->user->identity->type == 1) ? true : false,
                        'items' => [
                            ['label' => 'Senarai Pengguna', 'url' => ['admin/user-list'], 'icon' => 'users'],
                            ['label' => 'Senarai Pendaftaran', 'url' => ['admin/senarai-pendaftaran'], 'icon' => 'list'],
                            ['label' => 'Daftar Kejohanan', 'url' => ['admin/setup-index'], 'icon' => 'users'],
                            ['label' => 'Tambah Sukan', 'url' => ['refsukan/index'], 'icon' => 'users'],
                            ['label' => 'Tambah Kategori', 'url' => ['refkategori/index'], 'icon' => 'users'],
                            ['label' => 'Senarai Sukan', 'url' => ['admin/senarai-sukan'], 'icon' => 'users'],
                        ],
                    ],
                    [
                        'label' => 'Kontijen',
                        'icon' => 'university',
                        'items' => [
                            ['label' => 'Profil Kontijen', 'url' => ['kontijen/profil-kontijen?id='.$model->id], 'icon' => 'university'],

                            ['label' => 'Senarai Pendaftaran', 'url' => ['kontijen/senarai-pendaftaran'], 'icon' => 'th-list'],
                            ['label' => 'Pendaftaran Peserta', 'url' => ['kontijen/index-peserta'], 'icon' => 'edit'],

                            // ['label' => 'Daftar Pemain', 'url' => ['kontijen/daftar-pemain'], 'icon' => 'user'],
                            // ['label' => 'Pendaftaran Awal Kejohanan', 'url' => ['site/pendaftaran-awal'], 'icon' => 'edit'],
                            ['label' => 'Pendaftaran Penginapan', 'url' => ['site/pendaftaran-penginapan'], 'icon' => 'hotel'],
                        ],
                    ],

                    [
                        'label' => 'Pengesahan',
                        'icon' => 'check-square',
                        'items' => [
                            ['label' => 'Borang G-1', 'url' => ['kontijen/borang-pengesahan-awal-penyertaan?id='.$daftar->id], 'icon' => 'file'],

                        ],
                    ],
                ],
            ]);

            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>