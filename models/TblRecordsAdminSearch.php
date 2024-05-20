<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblRecordsAdmin;

/**
 * TblRecordsAdminSearch represents the model behind the search form of `app\models\TblRecordsAdmin`.
 */
class TblRecordsAdminSearch extends TblRecordsAdmin
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rp', 'r1', 'r4', 'jum_baja', 'fleet_rp', 'fleet_r1', 'fleet_r4', 'fleet_jum_baja'], 'integer'],
            [['tarikh_sps', 'no_sps_42', 'no_sps_40', 'modul', 'nama_pekebun', 'nama_ppr', 'status', 'fleet_tarikh_terima', 'fleet_tarikh_bekalan', 'added_by', 'added_dt', 'update_by', 'update_dt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TblRecordsAdmin::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'rp' => $this->rp,
            'r1' => $this->r1,
            'r4' => $this->r4,
            'jum_baja' => $this->jum_baja,
            'fleet_tarikh_terima' => $this->fleet_tarikh_terima,
            'fleet_tarikh_bekalan' => $this->fleet_tarikh_bekalan,
            'fleet_rp' => $this->fleet_rp,
            'fleet_r1' => $this->fleet_r1,
            'fleet_r4' => $this->fleet_r4,
            'fleet_jum_baja' => $this->fleet_jum_baja,
            'added_dt' => $this->added_dt,
            'update_dt' => $this->update_dt,
        ]);

        $query->andFilterWhere(['like', 'tarikh_sps', $this->tarikh_sps])
            ->andFilterWhere(['like', 'no_sps_42', $this->no_sps_42])
            ->andFilterWhere(['like', 'no_sps_40', $this->no_sps_40])
            ->andFilterWhere(['like', 'modul', $this->modul])
            ->andFilterWhere(['like', 'nama_pekebun', $this->nama_pekebun])
            ->andFilterWhere(['like', 'nama_ppr', $this->nama_ppr])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'added_by', $this->added_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}
