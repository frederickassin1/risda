<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_sps_group".
 *
 * @property int $id
 * @property string|null $sps_group
 * @property int|null $status 1- aktif , 0 - inactive
 * @property string|null $added_by
 * @property string|null $added_dt
 */
class RefSpsGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_sps_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['added_dt'], 'safe'],
            [['sps_group'], 'string', 'max' => 25],
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
            'sps_group' => 'Sps Group',
            'status' => 'Status',
            'added_by' => 'Added By',
            'added_dt' => 'Added Dt',
        ];
    }
}
