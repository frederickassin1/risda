<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblPenyertaan;

/**
 * TblPenyertaanSearch represents the model behind the search form of `app\models\TblPenyertaan`.
 */
class TblPenyertaanSearch extends TblPenyertaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ipta_id', 'kategori_id', 'created_by', 'updated_by', 'senior', 'veteran', 'senior_veteran', 'total'], 'integer'],
            [['status', 'created_dt', 'update_dt'], 'safe'],
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
        $query = TblPenyertaan::find();

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
            'ipta_id' => $this->ipta_id,
            'kategori_id' => $this->kategori_id,
            'created_dt' => $this->created_dt,
            'created_by' => $this->created_by,
            'update_dt' => $this->update_dt,
            'updated_by' => $this->updated_by,
            'senior' => $this->senior,
            'veteran' => $this->veteran,
            'senior_veteran' => $this->senior_veteran,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
