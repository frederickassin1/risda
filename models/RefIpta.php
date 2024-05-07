<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_ipta".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $shortname
 */
class RefIpta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_ipta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 250],
            [['shortname'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'IPTA',
            'shortname' => 'Shortname',
        ];
    }
}
