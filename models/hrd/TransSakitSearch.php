<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\TransSakit;

/**
 * TransSakitSearch represents the model behind the search form of `app\models\hrd\TransSakit`.
 */
class TransSakitSearch extends TransSakit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sakit', 'id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['tgl', 'keterangan', 'created_at', 'updated_at'], 'safe'],
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
        $query = TransSakit::find();

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
            'id_sakit' => $this->id_sakit,
            'id_karyawan' => $this->id_karyawan,
            'tgl' => $this->tgl,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
