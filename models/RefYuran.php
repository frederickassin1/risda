<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_yuran".
 *
 * @property int $id
 * @property string|null $nama
 * @property int|null $jenis_id 1 - yuran , 2- individu , 3- berkumpulan
 * @property int|null $kategori_id (fk)ref_kategori
 * @property float|null $total
 */
class RefYuran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_yuran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenis_id', 'kategori_id','sukan_id'], 'integer'],
            [['total'], 'number'],
            [['nama'], 'string', 'max' => 150],
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
            'jenis_id' => 'Jenis ID',
            'kategori_id' => 'Kategori ID',
            'total' => 'Total',
        ];
    }

    public static function yuran($kategori_id){
        $val = "";
        $yuran = RefYuran::find()->where(['kategori_id' => $kategori_id])->one();
        if($yuran){
            $val = $yuran->total;
        }
        return $val;
    }
    public static function check($id){
        $model = self::findOne(['kategori_id'=>$id]);
        if($model){
            return $model->total;
        }
        return 0;

    }
}
