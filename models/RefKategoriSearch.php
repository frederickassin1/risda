<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefKategori;

/**
 * RefKategoriSearch represents the model behind the search form of `app\models\RefKategori`.
 */
class RefKategoriSearch extends RefKategori
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sukan_id', 'create_by', 'update_by', 'status'], 'integer'],
            [['kategori', 'created_dt', 'update_dt'], 'safe'],
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
        $query = RefKategori::find();

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
            'sukan_id' => $this->sukan_id,
            'created_dt' => $this->created_dt,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
            'update_dt' => $this->update_dt,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'kategori', $this->kategori]);

        return $dataProvider;
    }
}
