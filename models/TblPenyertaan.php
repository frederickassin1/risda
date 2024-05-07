<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penyertaan".
 *
 * @property int $id
 * @property int|null $ipta_id fk - ref_ipta
 * @property int|null $kategori_id fk - ref_kategori
 * @property string|null $status
 * @property string|null $created_dt
 * @property int|null $created_by fk - tbl_users
 * @property string|null $update_dt
 * @property int|null $updated_by
 * @property int|null $senior
 * @property int|null $veteran
 * @property int|null $senior_veteran
 */
class TblPenyertaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_penyertaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total','ipta_id', 'kategori_id', 'created_by', 'updated_by', 'senior', 'veteran', 'senior_veteran'], 'integer'],
            [['created_dt', 'update_dt'], 'safe'],
            [['status'], 'string', 'max' => 20],
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
            'kategori_id' => 'Kategori ID',
            'status' => 'Status',
            'created_dt' => 'Created Dt',
            'created_by' => 'Created By',
            'update_dt' => 'Update Dt',
            'updated_by' => 'Updated By',
            'senior' => 'Senior',
            'veteran' => 'Veteran',
            'senior_veteran' => 'Senior Veteran',
            'total' => 'Total',
        ];
    }
    public static function check($id){
        $user = Yii::$app->user->identity->id; //getting user id
        $model = self::findOne(['created_by'=>$user,'id'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
    public static function checked($id){
        $user = Yii::$app->user->identity->id; //getting user id
        $model = self::findOne(['created_by'=>$user,'id'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
}
