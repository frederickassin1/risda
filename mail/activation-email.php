<?php
/* @var $this yii\web\View */
/* @var $user app\models\TblUsers */

use yii\helpers\Html;

$activationLink = Yii::$app->urlManager->createAbsoluteUrl(['site/activate', 'token' => $user->activation_token]);
?>

<p>YBhg. Tan Sri/ Datuk/ Dato / Datin/ Dr./ Tuan/ Puan <?= $user->fullname ?></p>,

<p>Sila klik pautan dibawah untuk pengaktifan Akaun PP-JPANS:
    <?= Html::a($activationLink, $activationLink); ?>
</p>

<p>Sebarang masalah sila hubungi :</p>
<p>088-368600 / 368601</p>
atau
<p>sbpt.jpan@sabah.gov.my</p>

<p>Sekian, terima kasih.</p>
