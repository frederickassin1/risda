<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_jum_baja".
 *
 * @property int $int
 * @property int|null $rp
 * @property int|null $r1
 * @property int|null $r4
 * @property string|null $added_dt
 * @property string|null $added_by
 * @property string|null $description
 */
class TblJumBaja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_jum_baja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rp', 'r1', 'r4'], 'integer'],
            [['added_dt'], 'safe'],
            [['description'], 'string'],
            [['added_by'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'int' => 'Int',
            'rp' => 'Rp',
            'r1' => 'R1',
            'r4' => 'R4',
            'added_dt' => 'Added Dt',
            'added_by' => 'Added By',
            'description' => 'Description',
        ];
    }
}
