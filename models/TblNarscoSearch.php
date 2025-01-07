<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblNarsco;

/**
 * TblNarscoSearch represents the model behind the search form of `app\models\TblNarsco`.
 */
class TblNarscoSearch extends TblNarsco
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rp', 'r1', 'r4', 'rp_masuk', 'rp_keluar', 'rp_baki', 'r1_masuk', 'r1_keluar', 'r1_baki', 'r4_masuk', 'r4_keluar', 'r4_baki'], 'integer'],
            [['no_sps_40', 'tarikh_keluar', 'tarikh_masuk', 'added_by', 'added_dt'], 'safe'],
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
        $query = TblNarsco::find();

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
            'tarikh_keluar' => $this->tarikh_keluar,
            'tarikh_masuk' => $this->tarikh_masuk,
            'rp' => $this->rp,
            'r1' => $this->r1,
            'r4' => $this->r4,
            'rp_masuk' => $this->rp_masuk,
            'rp_keluar' => $this->rp_keluar,
            'rp_baki' => $this->rp_baki,
            'r1_masuk' => $this->r1_masuk,
            'r1_keluar' => $this->r1_keluar,
            'r1_baki' => $this->r1_baki,
            'r4_masuk' => $this->r4_masuk,
            'r4_keluar' => $this->r4_keluar,
            'r4_baki' => $this->r4_baki,
            'added_dt' => $this->added_dt,
        ]);

        $query->andFilterWhere(['tarikh_keluar' => date('Y')]);
        $query->andFilterWhere(['like', 'no_sps_40', $this->no_sps_40])
            ->andFilterWhere(['like', 'added_by', $this->added_by]);

        return $dataProvider;
    }
}
