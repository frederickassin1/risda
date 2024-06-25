<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblRecordsAdmin;
use yii\helpers\VarDumper;

/**
 * TblRecordsAdminSearch represents the model behind the search form of `app\models\TblRecordsAdmin`.
 */
class TblRecordsAdminSearch extends TblRecordsAdmin
{
    /**
     * {@inheritdoc}
     */
    public $sps_group; // Add a new attribute for searching ]
    public $sps_no; // Add a new attribute for searching ]
    public $modul; // Add a new attribute for searching 
    public $nama; // Add a new attribute for searching on nama_pekebun (a related field)

    public function rules()
    {
        return [
            [['id', 'rp', 'r1', 'r4', 'jum_baja', 'fleet_rp', 'fleet_r1', 'fleet_r4', 'fleet_jum_baja'], 'integer'],
            // [['', 'sps_no','modul','nama'],'safe'],
            [['sps_group','nama','tarikh_sps', 'no_sps_42', 'no_sps_40', 'modul', 'nama_pekebun', 'nama_ppr', 'status', 'fleet_tarikh_terima', 'fleet_tarikh_bekalan', 'added_by', 'added_dt', 'update_by', 'update_dt'], 'safe'],
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
        $query->joinWith(['sgroup']);
        // $query->joinWith(['pekebun as p']);
        $query->joinWith(['smodul']);
        $query->joinWith(['pekebun']);
        // $query->joinWith(['pekebun as p']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'tarikh_sps',
                    'no_sps_42' => [
                        'asc' => ['ref_sps_group.sps_group' => SORT_ASC],
                        'desc' => ['ref_sps_group.sps_group' => SORT_DESC],
                    ],
                    'no_sps_40' => [
                        'asc' => ['tbl_penerima_baja.no_sps' => SORT_ASC],
                        'desc' => ['tbl_penerima_baja.no_sps' => SORT_DESC],
                    ],
                    'modul' => [
                        'asc' => ['ref_modul.modul' => SORT_ASC],
                        'desc' => ['ref_modul.modul' => SORT_DESC],
                    ],
                    'nama' => [
                        'asc' => ['tbl_penerima_baja.fullname' => SORT_ASC],
                        'desc' => ['tbl_penerima_baja.fullname' => SORT_DESC],
                    ],
                    'rp',
                    'r1',
                    'r4',
                    'status',
                ],
            ],
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
            // ->andFilterWhere(['like', 'no_sps_42', $this->no_sps_42])
            // ->andFilterWhere(['like', 'no_sps_40', $this->no_sps_40])
            // ->andFilterWhere(['like', 'modul', $this->modul])
            ->andFilterWhere(['like', 'nama_pekebun', $this->nama_pekebun])
            ->andFilterWhere(['like', 'nama_ppr', $this->nama_ppr])
            ->andFilterWhere(['like', 'tbl_records_admin.status', $this->status])
            ->andFilterWhere(['like', 'added_by', $this->added_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'ref_sps_group.sps_group', $this->no_sps_42])
            ->andFilterWhere(['like', 'ref_modul.modul', $this->modul])
            ->andFilterWhere(['like', 'tbl_penerima_baja.no_sps', $this->no_sps_40])
            ->andFilterWhere(['like', 'tbl_penerima_baja.fullname', $this->nama]);
            // ->andFilterWhere(['like', 'f.fullname', $this->no_sps_40])
            // ->andFilterWhere(['like', 'p.no_sps', $this->no_sps_40]);
        // VarDumper::dump($dataProvider, $depth = 10, $highlight = true);die;

        return $dataProvider;
    }
}
