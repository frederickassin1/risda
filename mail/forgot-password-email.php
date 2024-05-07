<?php
/* @var $this yii\web\View */
/* @var $user app\models\TblUsers */

use yii\helpers\Html;


$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);

?>

<p>YBhg. Tan Sri/ Datuk/ Dato / Datin/ Dr./ Tuan/ Puan&nbsp;<?= Html::encode($user->fullname) ?>,</p>

<p>Klik pautan di bawah untuk menetapkan semula kata laluan.</p>

<?= Html::a($resetLink, $resetLink); ?>

<p>Sebarang masalah sila hubungi :</p>
<p>088-368600 / 368601</p>
atau
<p>sbpt.jpan@sabah.gov.my</p>


<p>Sekian, terima kasih.</p>