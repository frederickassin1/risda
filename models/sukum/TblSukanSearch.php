<?php

namespace app\models\sukum;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sukum\TblSukan;

/**
 * TblSukanSearch represents the model behind the search form of `app\models\sukum\TblSukan`.
 */
class TblSukanSearch extends TblSukan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'create_by', 'update_by', 'status', 'jenis', 'maks', 'pengurus'], 'integer'],
            [['sukan', 'kategori', 'created_dt', 'update_dt', 'catatan'], 'safe'],
            [['yuran'], 'number'],
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
        $query = TblSukan::find();

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
            'created_dt' => $this->created_dt,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
            'update_dt' => $this->update_dt,
            'status' => $this->status,
            'yuran' => $this->yuran,
            'jenis' => $this->jenis,
            'maks' => $this->maks,
            'pengurus' => $this->pengurus,
        ]);

        $query->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
