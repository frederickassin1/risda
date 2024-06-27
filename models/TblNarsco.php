<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_narsco".
 *
 * @property int $int
 * @property string $no_sps_40
 * @property string $tarikh_keluar
 * @property string|null $tarikh_masuk
 * @property int|null $rp
 * @property int|null $r1
 * @property int|null $r4
 * @property int|null $rp_masuk
 * @property int|null $rp_keluar
 * @property int|null $rp_baki
 * @property int|null $r1_masuk
 * @property int|null $r1_keluar
 * @property int|null $r1_baki
 * @property int|null $r4_masuk
 * @property int|null $r4_keluar
 * @property int|null $r4_baki
 * @property string|null $added_by
 * @property string|null $added_dt
 */
class TblNarsco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_narsco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_sps_40', 'tarikh_keluar'], 'required'],
            [['tarikh_keluar', 'tarikh_masuk', 'added_dt'], 'safe'],
            [['record_id','rp', 'r1', 'r4', 'rp_masuk', 'rp_keluar', 'rp_baki', 'r1_masuk', 'r1_keluar', 'r1_baki', 'r4_masuk', 'r4_keluar', 'r4_baki'], 'integer'],
            [['no_sps_40'], 'string', 'max' => 25],
            [['added_by'], 'string', 'max' => 12],
            [['rp'], 'checkrp', 'on' => ['add']],
            [['r1'], 'checkr1', 'on' => ['add']],
            [['r4'], 'checkr4', 'on' => ['add']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'no_sps_40' => 'No Sps 40',
            'tarikh_keluar' => 'Tarikh Keluar',
            'tarikh_masuk' => 'Tarikh Masuk',
            'rp' => 'Rp',
            'r1' => 'R1',
            'r4' => 'R4',
            'rp_masuk' => 'Rp Masuk',
            'rp_keluar' => 'Rp Keluar',
            'rp_baki' => 'Rp Baki',
            'r1_masuk' => 'R1 Masuk',
            'r1_keluar' => 'R1 Keluar',
            'r1_baki' => 'R1 Baki',
            'r4_masuk' => 'R4 Masuk',
            'r4_keluar' => 'R4 Keluar',
            'r4_baki' => 'R4 Baki',
            'added_by' => 'Added By',
            'added_dt' => 'Added Dt',
        ];
    }

    public function getPekebun()
    {
        return $this->hasOne(TblPenerimaBaja::className(), ['id' => 'no_sps_40']);
    }
    public static function baki($type){
        //type for jenis baja , id adalah utk check id rekod
        // $total = TblJumBaja::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();
        $total = TblInoutBaja::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();
        // $out = self::find()->where(['YEAR(tarikh_keluar)' => date('Y')])->sum($type);
        // $baki = $total->$type - $out;  
        return $total;

    }
    public function checkrp($attribute, $params)
    {
        $val =  TblRecordsAdmin::find()->where(['no_sps_40' => $this->no_sps_40])->andWhere(['status' => 0])->sum('rp');
        $narsco = self::find()->where(['no_sps_40' => $this->no_sps_40])->sum('rp');
        $value = $val - $narsco;
        if ($this->rp > $value) {
            $this->addError($attribute, 'Jumlah Baja Keluar Tidak Boleh Melebihi ' . floor($value) . '.');
        }
     
    }
    public function checkr1($attribute, $params)
    {
        $val =  TblRecordsAdmin::find()->where(['no_sps_40' => $this->no_sps_40])->andWhere(['status' => 0])->sum('r1');
        $narsco = self::find()->where(['no_sps_40' => $this->no_sps_40])->sum('r1');
        $value = $val - $narsco;
        if ($this->r1 > $value) {
            $this->addError($attribute, 'Jumlah Baja Keluar Tidak Boleh Melebihi ' . floor($value) . '.');
        }
    }
    public function checkr4($attribute, $params)
    {
        $val =  TblRecordsAdmin::find()->where(['no_sps_40' => $this->no_sps_40])->andWhere(['status' => 0])->sum('r4');
        $narsco = self::find()->where(['no_sps_40' => $this->no_sps_40])->sum('r4');
        $value = $val - $narsco;
        // $val = $val->sum('rp');
        // $ad = 180 - $gcr;
        //    var_dump($ad);die;

        if ($this->r4 > $value) {
            $this->addError($attribute, 'Jumlah Baja Keluar Tidak Boleh Melebihi ' . floor($value) . '.');
        }
    }
}
