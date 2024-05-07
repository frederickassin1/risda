<?php

namespace app\models;

use app\models\sukum\TblSukan;
use Yii;

/**
 * This is the model class for table "sukum.ref_sukan".
 *
 * @property int $id
 * @property string|null $nama
 * @property int|null $jenis 1 - Permainan, 2 - Olahraga
 * @property string|null $created_dt
 * @property string|null $create_by
 * @property string|null $update_by
 * @property string|null $update_dt
 * @property int|null $status 1 - Aktif, 2 - Tidak Aktif
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
            [['nama', 'jenis', 'status'], 'required', 'message' => 'Ruang ini adalah mandatori'],
            [['jenis', 'create_by', 'update_by', 'status','kategori'], 'integer'],
            [['created_dt', 'update_dt'], 'safe'],
            [['nama', ], 'string', 'max' => 255],
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
    
    public function getUser() {
        return $this->hasOne(TblUsers::className(), ['id' => 'create_by']);
    }
    
    public function getJenisSukan() {
        if ($this->jenis == '1') {
            return ' Permainan ';
        } 
       
        if ($this->jenis == '2') {
            return 'Olahraga';
        }    
    }
    public function getKategoris() {
        if ($this->jenis == '1') {
            return ' Berpasukan ';
        } 
       
        if ($this->jenis == '2') {
            return 'Individu';
        }    
    }
    
    public function getStatus() {
        if ($this->status == '1') {
            return ' Aktif ';
        } 
       
        if ($this->status == '2') {
            return 'Tidak Aktif';
        }
         
         
    }

    public function getnama()
    {
        return $this->hasOne(TblSukan::class, ['nama' => 'nama']); 
    }
}
