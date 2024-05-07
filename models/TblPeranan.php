<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sukum.tbl_peranan".
 *
 * @property int $id
 * @property string|null $role
 * @property int|null $status
 */
class TblPeranan extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'sukum.tbl_peranan';
    }

    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['peranan'], 'string', 'max' => 45],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'peranan' => 'Peranan',
            'status' => 'Status',
        ];
    }
}
