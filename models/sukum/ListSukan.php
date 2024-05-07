<?php

namespace app\models\sukum;

use app\models\TblPemain;
use Yii;

/**
 * This is the model class for table "tbl_list_sukan".
 *
 * @property int $id
 * @property int|null $penyertaanID fk - ref_ipta
 * @property int|null $sukanID fk - ref_kategori
 * @property string|null $created_dt
 * @property int|null $created_by fk - tbl_users
 * @property string|null $update_dt
 * @property int|null $updated_by
 * @property int|null $senior
 * @property int|null $veteran
 * @property int|null $senior_veteran
 * @property int|null $total jumlah atlet /acara
 */
class ListSukan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_list_sukan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendaftaranID', 'sukanID', 'created_by', 'updated_by', 'senior', 'veteran', 'senior_veteran', 'total'], 'integer'],
            [['yuran'],'float'],
            [['created_dt', 'update_dt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'penyertaanID' => 'Penyertaan ID',
            'sukanID' => 'Sukan ID',
            'created_dt' => 'Created Dt',
            'created_by' => 'Created By',
            'update_dt' => 'Update Dt',
            'updated_by' => 'Updated By',
            'senior' => 'Senior',
            'veteran' => 'Veteran',
            'senior_veteran' => 'Senior Veteran',
            'total' => 'Total',
            'yuran' => 'Yuran'
        ];
    }
      public static function check($id){
        $user = Yii::$app->user->identity->id; //getting user id
        $model = self::findOne(['created_by'=>$user,'sukanID'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
    public static function checked($id){
        $user = Yii::$app->user->identity->id; //getting user id
        $model = self::findOne(['created_by'=>$user,'sukanID'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
    
    public function getSukan()
    {
        return $this->hasOne(TblSukan::class, ['id' => 'sukanID']); 
    }
    public function getPemain()
    {
        return $this->hasMany(TblPemain::class, ['listsukan_id' => 'id']); 
    }
    public function getPerananPemain()
    {
        return $this->hasOne(TblPemain::class, ['listsukan_id' => 'id']); 
    }
    public function getNamaSukan()
    {
        return $this->hasOne(TblSukan::class, ['nama' => 'sukan']); 
    }
}
