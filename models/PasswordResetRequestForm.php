<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Sila Masukkan Alamat Emel Anda.'],
            ['email', 'email', 'message' => 'Sila Masukkan Alamat Emel yang Sah.'],
            [
                'email', 'exist',
                'targetClass' => '\app\models\TblUsers',
                'filter' => ['status' => 1],
                'message' => 'Emel ini tidak berdaftar dengan sistem.'
            ],
        ];
    }

    public function sendEmail()
    {
        /* @var $user TblUsers */
        $user = TblUsers::findOne([
            'status' => 1,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        $user->generatePasswordResetToken();

        if (!$user->save(false)) {
            return false;
        }

        return Yii::$app->mailer->compose('forgot-password-email', ['user' => $user])
            ->setFrom('noreply@pp-jpans.metatret.com')
            ->setTo($this->email)
            ->setSubject('Lupa Kata laluan PP-JPANS')
            ->send();
    }
}
