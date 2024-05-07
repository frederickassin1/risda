<?php

namespace app\models\sukum;

use Yii;

/**
 * This is the model class for table "ref_status".
 *
 * @property int $id
 * @property string|null $status
 * @property string|null $kategori
 */
class RefStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'kategori'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'kategori' => 'Kategori',
        ];
    }
}
