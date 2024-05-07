<?php

namespace app\models\sukum;

use app\models\TblUsers;
use Yii;

/**
 * This is the model class for table "tbl_pendaftaran".
 *
 * @property int $id
 * @property int|null $created_by fk - tbl_users
 * @property string|null $created_dt
 * @property int|null $update_by
 * @property string|null $updated_dt
 * @property string|null $status
 */
class TblPendaftaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_pendaftaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'update_by','ipta_id'], 'integer'],
            [['created_dt', 'updated_dt'], 'safe'],
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'created_dt' => 'Created Dt',
            'update_by' => 'Update By',
            'updated_dt' => 'Updated Dt',
            'status' => 'Status',
        ];
    }

    public function getPendaftar()
    {
        return $this->hasOne(TblUsers::className(), ['id' => 'created_by']);
    }

    public function getStatuss() {
        return $this->hasOne(RefStatus::class, ['id' => 'status']);
    }
    public function getS()
    {
        return $this->hasOne(ListSukan::class, ['pendaftaranId' => 'id']); 
    }

}
