<?php

namespace app\models;

use app\models\sukum\ListSukan;
use Yii;

/**
 * This is the model class for table "tbl_pemain".
 *
 * @property int $id
 * @property string|null $icno
 * @property int|null $role
 * @property int|null $listsukan_id
 * @property int|null $status
 */
class TblPemain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_pemain';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'listsukan_id', 'status'], 'integer'],
            [['icno'], 'string', 'max' => 15],
            [['icno'], 'unique', 'targetAttribute'=>['icno','role','listsukan_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'icno' => 'Icno',
            'role' => 'Role',
            'listsukan_id' => 'Listsukan ID',
            'status' => 'Status',
        ];
    }
    public function getBiodata()
    {
        return $this->hasOne(TblPeserta::class, ['nokp' => 'icno']); 
    }

    public function getPeranan()
    {
        return $this->hasOne(TblPeranan::class, ['id' => 'role']); 
    }

    public function getListSukan()
    {
        return $this->hasOne(ListSukan::class, ['sukanID' => 'listsukan_id']); 
    }

}
