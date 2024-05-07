<?php

namespace app\models\sukum;

use Yii;

/**
 * This is the model class for table "sukum.vw_invois".
 *
 * @property int $id
 * @property string|null $sukan ref_sukan
 * @property string|null $kategori
 * @property float|null $yuran
 * @property int|null $total jumlah atlet /acara
 * @property float|null $JUMLAH
 * @property float|null $JUMLAH_BESAR
 */
class VwInvois extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sukum.vw_invois';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'total'], 'integer'],
            [['yuran', 'JUMLAH', 'JUMLAH_BESAR'], 'number'],
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
            'sukan' => 'Sukan',
            'kategori' => 'Kategori',
            'yuran' => 'Yuran',
            'total' => 'Total',
            'JUMLAH' => 'Jumlah',
            'JUMLAH_BESAR' => 'Jumlah Besar',
        ];
    }
}
