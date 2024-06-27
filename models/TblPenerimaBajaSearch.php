<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblPenerimaBaja;

/**
 * TblPenerimaBajaSearch represents the model behind the search form of `app\models\TblPenerimaBaja`.
 */
class TblPenerimaBajaSearch extends TblPenerimaBaja
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'status', 'update_by', 'no_tel', 'role'], 'integer'],
            [['fullname', 'email', 'password', 'create_dt', 'update_dt', 'icno', 'no_sps'], 'safe'],
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
        $query = TblPenerimaBaja::find();

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
            'type' => $this->type,
            'status' => $this->status,
            'create_dt' => $this->create_dt,
            'update_dt' => $this->update_dt,
            'update_by' => $this->update_by,
            'no_tel' => $this->no_tel,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'icno', $this->icno])
            ->andFilterWhere(['like', 'no_sps', $this->no_sps]);

        return $dataProvider;
    }
}
