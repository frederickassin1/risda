<?php

namespace app\models\sukum;

use Yii;

/**
 * This is the model class for table "sukum.ref_sukan".
 *
 * @property int $id
 * @property string $nama
 * @property int $jenis 1-permainan, 2-olahraga
 * @property string $created_dt
 * @property string $create_by
 * @property string $update_by
 * @property string $update_dt
 * @property string $status
 */
class RefSukan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sukum.ref_sukan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama', 'jenis', 'status'], 'required', 'message' => 'Ruang ini adalah mandatori'],
            [['id'], 'required'],
            [['id', 'jenis'], 'integer'],
            [['created_dt', 'update_dt'], 'safe'],
            [['nama', 'create_by', 'update_by'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 8],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'jenis' => 'Jenis',
            'created_dt' => 'Created Dt',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'update_dt' => 'Update Dt',
            'status' => 'Status',
        ];
    }
}
