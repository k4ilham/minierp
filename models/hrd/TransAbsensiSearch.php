<?php

namespace app\models\hrd\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\TransAbsensi;

/**
 * TransAbsensiSearch represents the model behind the search form of `app\models\hrd\TransAbsensi`.
 */
class TransAbsensiSearch extends TransAbsensi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_absensi', 'id_karyawan', 'id_jam_kerja', 'status', 'created_by', 'updated_by'], 'integer'],
            [['periode', 'tgl_absen', 'in', 'out', 'created_at', 'updated_at'], 'safe'],
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
        $query = TransAbsensi::find();

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
            'id_absensi' => $this->id_absensi,
            'id_karyawan' => $this->id_karyawan,
            'id_jam_kerja' => $this->id_jam_kerja,
            'tgl_absen' => $this->tgl_absen,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode])
            ->andFilterWhere(['like', 'in', $this->in])
            ->andFilterWhere(['like', 'out', $this->out]);

        return $dataProvider;
    }
}
