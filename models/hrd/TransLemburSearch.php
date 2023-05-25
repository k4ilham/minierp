<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\TransLembur;

/**
 * TransLemburSearch represents the model behind the search form of `app\models\hrd\TransLembur`.
 */
class TransLemburSearch extends TransLembur
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lembur', 'id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['periode', 'tgl_lembur', 'jam_mulai', 'jam_selesai', 'durasi', 'jam_lembur', 'created_at', 'updated_at'], 'safe'],
            [['uang_lembur'], 'number'],
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
        $query = TransLembur::find();

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
            'id_lembur' => $this->id_lembur,
            'id_karyawan' => $this->id_karyawan,
            'uang_lembur' => $this->uang_lembur,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode])
            ->andFilterWhere(['like', 'tgl_lembur', $this->tgl_lembur])
            ->andFilterWhere(['like', 'jam_mulai', $this->jam_mulai])
            ->andFilterWhere(['like', 'jam_selesai', $this->jam_selesai])
            ->andFilterWhere(['like', 'durasi', $this->durasi])
            ->andFilterWhere(['like', 'jam_lembur', $this->jam_lembur]);

        return $dataProvider;
    }
}
