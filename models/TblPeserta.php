<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_peserta".
 *
 * @property int $id
 * @property string|null $nokp
 * @property string|null $nama
 * @property string|null $no_telefon
 * @property string|null $jantina
 * @property string|null $jawatan
 * @property string|null $tarikh_lantikan
 * @property int|null $id_kontinjen
 * @property string|null $date_created
 */
class TblPeserta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_peserta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tarikh_lantikan', 'date_created'], 'safe'],
            [['id_kontinjen'], 'integer'],
            [['nokp'], 'string', 'max' => 15],
            [['nama'], 'string', 'max' => 200],
            [['no_telefon', 'jawatan'], 'string', 'max' => 20],
            [['jantina'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nokp' => 'NO. KAD PENGENALAN',
            'nama' => 'NAMA',
            'no_telefon' => 'NO TELEFON',
            'jantina' => 'JANTINA',
            'jawatan' => 'JAWATAN',
            'tarikh_lantikan' => 'TARIKH LANTIKAN',
            'id_kontinjen' => 'NAMA KONTIJEN ',
            'date_created' => 'TARIKH KEMASKINI',
        ];
    }

    public function getKontinjen()
    {
        return $this->hasOne(RefIpta::className(), ['id' => 'id_kontinjen']);
    }

    public function getJantina_()
    {
        switch ($this->jantina) {
            case 'L':
                $value = 'LELAKI';
                break;
            case 'P':
                $value = 'PEREMPUAN';
                break;
            default:
                $value = '-';
                break;
        }
        return $value;
    }
}
