<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_records_admin".
 *
 * @property int $id
 * @property string|null $tarikh_sps
 * @property string|null $no_sps_42
 * @property string|null $no_sps_40
 * @property string|null $modul
 * @property string|null $nama_pekebun
 * @property string|null $nama_ppr
 * @property int|null $rp
 * @property int|null $r1
 * @property int|null $r4
 * @property int|null $jum_baja
 * @property string|null $status
 * @property string|null $fleet_tarikh_terima
 * @property string|null $fleet_tarikh_bekalan
 * @property int|null $fleet_rp
 * @property int|null $fleet_r1
 * @property int|null $fleet_r4
 * @property int|null $fleet_jum_baja
 * @property string|null $added_by
 * @property string|null $added_dt
 * @property string|null $update_by
 * @property string|null $update_dt
 */
class TblRecordsAdmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_records_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rp', 'r1', 'r4', 'jum_baja', 'fleet_rp', 'fleet_r1', 'fleet_r4', 'fleet_jum_baja'], 'integer'],
            [['fleet_tarikh_terima', 'fleet_tarikh_bekalan', 'added_dt', 'update_dt'], 'safe'],
            [['tarikh_sps', 'no_sps_42', 'no_sps_40', 'added_by', 'update_by'], 'string', 'max' => 20],
            [['modul'], 'string', 'max' => 5],
            [['nama_pekebun', 'nama_ppr'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarikh_sps' => 'Tarikh Sps',
            'no_sps_42' => 'No Sps 42',
            'no_sps_40' => 'No Sps 40',
            'modul' => 'Modul',
            'nama_pekebun' => 'Nama Pekebun',
            'nama_ppr' => 'Nama Ppr',
            'rp' => 'Rp',
            'r1' => 'R1',
            'r4' => 'R4',
            'jum_baja' => 'Jum Baja',
            'status' => 'Status',
            'fleet_tarikh_terima' => 'Fleet Tarikh Terima',
            'fleet_tarikh_bekalan' => 'Fleet Tarikh Bekalan',
            'fleet_rp' => 'Fleet Rp',
            'fleet_r1' => 'Fleet R1',
            'fleet_r4' => 'Fleet R4',
            'fleet_jum_baja' => 'Fleet Jum Baja',
            'added_by' => 'Added By',
            'added_dt' => 'Added Dt',
            'update_by' => 'Update By',
            'update_dt' => 'Update Dt',
        ];
    }
}
