<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_setup".
 *
 * @property int $id
 * @property int|null $created_by
 * @property string|null $fulldate_kejohanan
 * @property string|null $start_kejohanan
 * @property string|null $end_kejohanan
 * @property string|null $keterangan_kejohanan
 * @property string|null $fulldate_pra
 * @property string|null $start_pra
 * @property string|null $end_pra
 * @property string|null $fulldate_pengesahan
 * @property string|null $start_pengesahan
 * @property string|null $end_pengesahan
 * @property string|null $fulldate_qform
 * @property string|null $start_qform
 * @property string|null $end_qform
 * @property string|null $created_dt
 * @property string|null $kod_kejohanan
 * @property int|null $type [ 1 - Pengesahan Awal , 2 - Pendaftaran Atlet]
 * @property int|null $status
 * @property string|null $peraturan_am
 * @property string|null $logo
 * @property string|null $banner
 * @property string|null $facts
 */
class TblSetup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_setup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_by', 'type', 'status'], 'integer'],
            [['start_kejohanan', 'end_kejohanan', 'start_pra', 'end_pra', 'start_pengesahan', 'end_pengesahan', 'start_qform', 'end_qform', 'created_dt'], 'safe'],
            [['keterangan_kejohanan'], 'string'],
            [['fulldate_kejohanan', 'fulldate_pra', 'fulldate_pengesahan', 'fulldate_qform'], 'string', 'max' => 150],
            [['kod_kejohanan'], 'string', 'max' => 50],
            [['peraturan_am', 'logo', 'banner', 'facts'], 'string', 'max' => 250],
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
            'fulldate_kejohanan' => 'Fulldate Kejohanan',
            'start_kejohanan' => 'Start Kejohanan',
            'end_kejohanan' => 'End Kejohanan',
            'keterangan_kejohanan' => 'Keterangan Kejohanan',
            'fulldate_pra' => 'Fulldate Pra',
            'start_pra' => 'Start Pra',
            'end_pra' => 'End Pra',
            'fulldate_pengesahan' => 'Fulldate Pengesahan',
            'start_pengesahan' => 'Start Pengesahan',
            'end_pengesahan' => 'End Pengesahan',
            'fulldate_qform' => 'Fulldate Qform',
            'start_qform' => 'Start Qform',
            'end_qform' => 'End Qform',
            'created_dt' => 'Created Dt',
            'kod_kejohanan' => 'Kod Kejohanan',
            'type' => 'Type',
            'status' => 'Status',
            'peraturan_am' => 'Peraturan Am',
            'logo' => 'Logo',
            'banner' => 'Banner',
            'facts' => 'Facts',
        ];
    }
    public function getTypes(){
        $val = "";
        if ($this->status == "1") {
            $val = "Borang Pengesahan Awal";
        }else{
            $val = "Borang Pendaftaran Atlet";

        }
    return $val;
    }
    public function getStatuss(){
        $val = "";
        if ($this->status == "1") {
            $val = "Aktif";
        }else{
            $val = "Tidak Aktif";

        }
    return $val;
    }
    public function getUser(){
        return $this->hasOne(TblUsers::class, ['id' => 'created_by']);
    }
}
