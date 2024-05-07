<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penginapan".
 *
 * @property int $id
 * @property int|null $ipta_id
 * @property int|null $pegawai_lelaki
 * @property int|null $pegawai_wanita
 * @property int|null $atlet_lelaki
 * @property int|null $atlet_wanita
 * @property int|null $keseluruhan
 * @property int|null $create_by
 * @property string|null $create_dt
 * @property int|null $update_by
 * @property string|null $update_dt
 */
class TblPenginapan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_penginapan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ipta_id', 'pegawai_lelaki', 'pegawai_wanita', 'atlet_lelaki', 'atlet_wanita', 'keseluruhan', 'create_by', 'update_by'], 'integer'],
            [['create_dt', 'update_dt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ipta_id' => 'Ipta ID',
            'pegawai_lelaki' => 'Pegawai Lelaki',
            'pegawai_wanita' => 'Pegawai Wanita',
            'atlet_lelaki' => 'Atlet Lelaki',
            'atlet_wanita' => 'Atlet Wanita',
            'keseluruhan' => 'Jumlah Keseluruhan',
            'create_by' => 'Create By',
            'create_dt' => 'Create Dt',
            'update_by' => 'Update By',
            'update_dt' => 'Update Dt',
        ];
    }
}
