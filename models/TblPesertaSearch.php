<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblPeserta;
use Yii;
use yii\helpers\VarDumper;

/**
 * TblPesertaSearch represents the model behind the search form of `app\models\TblPeserta`.
 */
class TblPesertaSearch extends TblPeserta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_kontinjen'], 'integer'],
            [['nokp', 'nama', 'no_telefon', 'jantina', 'jawatan', 'tarikh_lantikan', 'date_created'], 'safe'],
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
        $query = TblPeserta::find();

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
            'tarikh_lantikan' => $this->tarikh_lantikan,
            'id_kontinjen' => $this->id_kontinjen,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'nokp', $this->nokp])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan]);

        return $dataProvider;
    }

    public function searchByIPTA($params)
    {
        $query = TblPeserta::find()->where(['id_kontinjen'=>Yii::$app->user->identity->ipta_id]);

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
            'tarikh_lantikan' => $this->tarikh_lantikan,
            'id_kontinjen' => $this->id_kontinjen,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'nokp', $this->nokp])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan]);

        return $dataProvider;
    }
}
