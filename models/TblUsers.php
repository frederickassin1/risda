<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_users".
 *
 * @property int $id
 * @property string|null $fullname
 * @property string|null $email
 * @property string|null $password
 * @property int|null $type
 * @property int|null $status
 * @property string|null $create_dt
 * @property string|null $update_dt
 */
class TblUsers extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    // Add a new property to store the password repeat value
    public $current_password;
    public $password_repeat;
    public $term;

    public $verifyCode;
    // private $default = "SUKUM@2024";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status', 'update_by','no_tel','role'], 'integer'],
            [['create_dt', 'update_dt', 'activation_token_expiry', 'password_reset_token_created_at'], 'safe'],
            [['fullname', 'activation_token', 'password_reset_token'], 'string', 'max' => 255],
            [['email', 'password'], 'string', 'max' => 200],
            [['icno'], 'string', 'max' => 12],

            [['email'], 'unique', 'message' => 'This email address has already been taken.'],
            // [['email', 'password', 'password_repeat', 'fullname'], 'required'],
            // Add the password repeat validation rule
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            // ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha'],
            ['current_password', 'validateCurrentPassword'],

            [['fullname', 'email', 'password', 'password_repeat'], 'required', 'on' => 'register'],
            ['term', 'required', 'message' => 'Anda harus bersetuju dengan terma.', 'on' => 'register'],
            [['fullname', 'email', 'type', 'status'], 'required', 'message' => 'Required Value', 'on' => 'update'],

        ];
    }

    public function generateActivationToken()
    {
        $this->activation_token = Yii::$app->security->generateRandomString() . '_' . time();
        $this->activation_token_expiry = date('Y-m-d H:i:s', strtotime('+24 hours')); // Token expires in 24 hours
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
        $this->password_reset_token_created_at = new \yii\db\Expression('NOW()');
    }

    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
        $this->password_reset_token_created_at = null;
    }



    public function validateCurrentPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->findIdentity(Yii::$app->user->id);
            if (!$user || !Yii::$app->security->validatePassword($this->current_password, $user->password)) {
                $this->addError($attribute, 'Incorrect current password.');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Nama Penuh',
            'email' => 'Emel',
            'password' => 'Kata Laluan',
            'password_repeat' => 'Ulang Kata Laluan',
            'type' => 'Type',
            'status' => 'Status',
            'create_dt' => 'Dibuat pada',
            'update_dt' => 'Dikemaskini pada',
            'term' => 'Setuju Terma',
            'updatedBy.nama' => 'Dikemaskini Oleh',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        // Define a default password
        $defaultPassword = "RISDA@2024";
    
        // Get user input (this assumes that the password is provided via a form input)
        $userInputPassword = $this->password; // Adjust this line based on how the password is passed in
    
        // Use the user-provided password if available, otherwise use the default
        $passwordToHash = !empty($userInputPassword) ? $userInputPassword : $defaultPassword;
    
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || $this->isAttributeChanged('password')) {
                // Hash the password before saving
                $this->password = Yii::$app->security->generatePasswordHash($passwordToHash);
            }
            return true;
        }
        return false;
    }
    public static function findIdentity($id)
    {
        return self::findOne(['email' => $id, 'status' => 1]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['email' => $username, 'status' => 1]);
    }

    public function getId()
    {
        return $this->email;
    }

    public function getAuthKey(): string
    {
        return $this->password;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->password === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // Use Yii2's built-in password validation method
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    /**
     * Finds user by password reset token.
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 1, // assuming 1 is the status for active users
        ]);
    }

    /**
     * Validates the password reset token.
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire']; // set this param in your config, e.g., 3600 for a 1-hour expiration
        return $timestamp + $expire >= time();
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(self::class, ['id' => 'update_by']);
    }

    public static function totalUsers($status)
    {
        $total = self::find()->where(['status' => $status])->count();

        return $total;
    }

    public function getStatusText()
    {



        if ($this->status == 1) {
            return 'Aktif';
        } else {
            return 'Tidak Aktif';
        }
    }

    public function getUserType()
    {



        if ($this->type === 1) {
            return 'Administrator';
        } else {
            return 'Pengguna Biasa';
        }
    }
   
}
