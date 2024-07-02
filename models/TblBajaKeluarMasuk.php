<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "tbl_inout_baja".
 *
 * @property int $id
 * @property string|null $tarikh_keluar
 * @property string|null $tarikh_masuk
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
 * @property string|null $description
 * @property int|null $narsco_id ref to tblnarsco if not null
 * @property int|null $type 1 = masuk , 2 = out
 */
class TblBajaKeluarMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_inout_baja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarikh_keluar', 'tarikh_masuk', 'added_dt'], 'safe'],
            [['rp_masuk', 'rp_keluar', 'rp_baki', 'r1_masuk', 'r1_keluar', 'r1_baki', 'r4_masuk', 'r4_keluar', 'r4_baki', 'narsco_id', 'type'], 'integer'],
            [['description'], 'string'],
            [['added_by'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tarikh_keluar' => 'Tarikh Keluar',
            'tarikh_masuk' => 'Tarikh Masuk',
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
            'description' => 'Description',
            'narsco_id' => 'Narsco ID',
            'type' => 'Type',
        ];
    }
    public static function check($id)
    {
        $val = '';
        $model = self::find()->orderBy(['added_dt' => SORT_DESC])->one();

        if($model->id == $id){
            $val = true;
        }
        return $val;
    }
    public static function baki($type){
        //type for jenis baja , id adalah utk check id rekod
        // $total = TblJumBaja::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();
        $total = TblInoutBaja::find()->where(['YEAR(added_dt)' => date('Y')])->orderBy(['added_dt' => SORT_DESC])->one();
        $out = self::find()->where(['YEAR(tarikh_keluar)' => date('Y')])->sum($type);
        // $baki = $total->$type - $out;  
        return $total;

    }
}
