<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;

?>

<div class="card card-primary card-outline heavy">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-phone"></i>&nbsp;Hubungi Kami</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <p>
            <strong>Jabatan Teknologi Maklumat & Komunikasi,</strong><br>
            Universiti Malaysia Sabah,<br>
            88400, Kota Kinabalu, Sabah<br>
        </p>

        <p>
            <?php echo Html::img('@web/images/phone.png',['width' => '25px',]); ?>088-320000<br>
            <?php echo Html::img('@web/images/email.png',['width' => '25px',]); ?>helpdesk[at]ums.edu.my<br>
            <?php echo Html::img('@web/images/fb_icon.png',['width' => '25px',]); ?>ditc.jtmkums<br>
        </p>

        <p><strong>Lokasi</strong> <br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.668166426097!2d116.12453107498891!3d6.040189593945461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x323b6b64335685ff%3A0xd37d1526e5aed071!2sJabatan%20Teknologi%20Maklumat%20%26%20Komunikasi!5e0!3m2!1sen!2smy!4v1699595579039!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </p>

    </div>
</div>