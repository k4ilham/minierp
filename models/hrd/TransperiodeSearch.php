<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\Transperiode;

/**
 * TransperiodeSearch represents the model behind the search form of `app\models\hrd\Transperiode`.
 */
class TransperiodeSearch extends Transperiode
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_periode', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['periode', 'tgl_gaji', 'tgl_absen_awal', 'tgl_absen_akhir', 'tgl_posting', 'created_at', 'updated_at'], 'safe'],
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
        $query = Transperiode::find();

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
            'id_periode' => $this->id_periode,
            'aktif' => $this->aktif,
            'tgl_gaji' => $this->tgl_gaji,
            'tgl_absen_awal' => $this->tgl_absen_awal,
            'tgl_absen_akhir' => $this->tgl_absen_akhir,
            'tgl_posting' => $this->tgl_posting,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode]);

        return $dataProvider;
    }
}
