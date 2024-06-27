<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblBajaKeluarMasuk;

/**
 * TblBajaKeluarMasukSearch represents the model behind the search form of `app\models\TblBajaKeluarMasuk`.
 */
class TblBajaKeluarMasukSearch extends TblBajaKeluarMasuk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rp_masuk', 'rp_keluar', 'rp_baki', 'r1_masuk', 'r1_keluar', 'r1_baki', 'r4_masuk', 'r4_keluar', 'r4_baki', 'narsco_id', 'type'], 'integer'],
            [['tarikh_keluar', 'tarikh_masuk', 'added_by', 'added_dt', 'description'], 'safe'],
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
        $query = TblBajaKeluarMasuk::find();

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
            'narsco_id' => $this->narsco_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'added_by', $this->added_by])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
