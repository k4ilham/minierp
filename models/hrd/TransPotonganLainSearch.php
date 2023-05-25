<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\TransPotonganLain;

/**
 * TransPotonganLainSearch represents the model behind the search form of `app\models\hrd\TransPotonganLain`.
 */
class TransPotonganLainSearch extends TransPotonganLain
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_potongan_lain', 'id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['tgl', 'periode', 'keterangan', 'created_at', 'updated_at'], 'safe'],
            [['nominal'], 'number'],
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
        $query = TransPotonganLain::find();

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
            'id_potongan_lain' => $this->id_potongan_lain,
            'id_karyawan' => $this->id_karyawan,
            'tgl' => $this->tgl,
            'nominal' => $this->nominal,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
