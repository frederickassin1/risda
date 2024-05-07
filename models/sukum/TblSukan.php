<?php

namespace app\models\sukum;
use app\models\TblUsers;

use Yii;

/**
 * This is the model class for table "tbl_sukan".
 *
 * @property int $id
 * @property string|null $sukan_id ref_sukan
 * @property string|null $kategori
 * @property string|null $created_dt
 * @property int|null $create_by
 * @property int|null $update_by
 * @property string|null $update_dt
 * @property int|null $status 0- inactive , 1- active
 * @property float|null $yuran
 */
class TblSukan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_sukan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_dt', 'update_dt'], 'safe'],
            [['create_by', 'update_by', 'status'], 'integer'],
            [['yuran'], 'number'],
            // [['maks'], 'check', 'on' => ['max']], //supaya tidak lebih dari maximum yg kena set

            [['sukan'], 'string', 'max' => 100],
            [['kategori'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sukan' => 'Sukan ID',
            'kategori' => 'Kategori',
            'created_dt' => 'Created Dt',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'update_dt' => 'Update Dt',
            'status' => 'Status',
            'yuran' => 'Yuran',
        ];
    }
    // public function checkBs($attribute, $params)
    // {
    //     $model = self::find()->where(['id' => $this->id])->one();

    //     if ($model->max > 360) {

    //         $this->addError($attribute, 'Kelayakan Anda Tidak Mencukupi, Sila Pilih Pilihan Lain!');
    //     }
    // }
    public static function check($id){
        $user = Yii::$app->user->identity->id; //getting user id
        $model = self::findOne(['create_by'=>$user,'sukan'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
    public static function checked($id){
        $user = Yii::$app->user->identity->id; //getting user id
        $model = self::findOne(['create_by'=>$user,'sukan'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
    public function getFullname(){
       return $this->sukan.' '.$this->kategori;
    }
    public function getStatussukan(){
       if($this->status == 1){
        return 'DiPertandingkan';
       }else{
        return 'tidak dipertandingkan';
       }
    }
    public function getJenissukan(){
       if($this->status == 1){
        return 'Individu';
       }else{
        return 'Berkumpulan';
       }
    }

    public function getNamaSukan()
    {
        return $this->hasOne(RefSukan::class, ['nama' => 'sukan']); 
    }
    // public function getUser() {
    //     return $this->hasOne();
    // }
}
