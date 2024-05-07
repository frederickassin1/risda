<?php

namespace app\models\sukum;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sukum\RefSukan;

/**
 * RefSukanSearch represents the model behind the search form of `app\models\sukum\RefSukan`.
 */
class RefSukanSearch extends RefSukan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis'], 'integer'],
            [['nama', 'created_dt', 'create_by', 'update_by', 'update_dt', 'status'], 'safe'],
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
        $query = RefSukan::find();

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
            'jenis' => $this->jenis,
            'created_dt' => $this->created_dt,
            'update_dt' => $this->update_dt,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'create_by', $this->create_by])
            ->andFilterWhere(['like', 'update_by', $this->update_by])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
