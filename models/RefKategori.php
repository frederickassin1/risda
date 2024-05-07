<?php

namespace app\models;
use app\models\RefSukan;
use app\models\TblUsers;
use Yii;

/**
 * This is the model class for table "ref_kategori".
 *
 * @property int $id
 * @property int|null $sukan_id ref_sukan
 * @property string|null $kategori
 * @property string|null $created_dt
 * @property int|null $create_by
 * @property int|null $update_by
 * @property string|null $update_dt
 * @property int|null $status 0- inactive , 1- active
 */
class RefKategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_kategori';
    }

    public $maks;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sukan_id', 'kategori', 'status'], 'required', 'message' => 'Ruang ini adalah mandatori'],
            [['sukan_id', 'create_by', 'update_by', 'status', 'min','max', 'jurulatih', 'pengerusi'], 'integer'],
            [['created_dt', 'update_dt'], 'safe'],
            [['kategori'], 'string', 'max' => 250],
            [['yuran','maks'], 'number'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sukan_id' => 'Sukan ID',
            'kategori' => 'Kategori',
            'created_dt' => 'Created Dt',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
            'update_dt' => 'Update Dt',
            'status' => 'Status',
            'min' => 'Min',
            'max' => 'Max',
            'pengerusi' => 'Pengerusi',
            'jurulatih' => 'Jurulatih',
        ];
    }

    public function getSukan() {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan_id']);
    }

    public function getUser() {
        return $this->hasOne(TblUsers::className(), ['id' => 'create_by']);
    }

    public function getStatus() {
        if ($this->status == '1') {
            return ' Aktif ';
        } 
       
        if ($this->status == '2') {
            return ' Tidak Aktif ';
        }
         
         
    }
}
