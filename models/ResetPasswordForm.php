<?php

namespace app\models;

use yii\base\Model;

class ResetPasswordForm extends Model
{
    public $password;
    private $_user;

    public function __construct($token, $config = [])
    {
        $this->_user = TblUsers::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new \yii\base\InvalidArgumentException('Invalid password reset token.');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        $user->password = $this->password;
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
