<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penerima_baja".
 *
 * @property int $id
 * @property string|null $fullname
 * @property string|null $email
 * @property string|null $password
 * @property int|null $type
 * @property int|null $status
 * @property string|null $create_dt
 * @property string|null $update_dt
 * @property int|null $update_by
 * @property string|null $icno
 * @property int|null $no_tel
 * @property int|null $role
 * @property string|null $no_sps
 */
class TblPenerimaBaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_penerima_baja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status', 'update_by', 'no_tel', 'role'], 'integer'],
            [['create_dt', 'update_dt'], 'safe'],
            [['fullname'], 'string', 'max' => 255],
            [['no_sps'], 'unique', 'message' => 'SPS sudah digunakan.'],

            [['email', 'password'], 'string', 'max' => 200],
            [['icno'], 'string', 'max' => 12],
            [['no_sps'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Nama Penerima',
            'email' => 'Email',
            'password' => 'Password',
            'type' => 'Type',
            'status' => 'Status',
            'create_dt' => 'Create Dt',
            'update_dt' => 'Update Dt',
            'update_by' => 'Update By',
            'icno' => 'Icno',
            'no_tel' => 'No Tel',
            'role' => 'Role',
            'no_sps' => 'No Sps40',
        ];
    }
}
