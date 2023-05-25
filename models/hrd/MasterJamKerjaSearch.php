<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\MasterJamKerja;

/**
 * MasterJamKerjaSearch represents the model behind the search form of `app\models\hrd\MasterJamKerja`.
 */
class MasterJamKerjaSearch extends MasterJamKerja
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jam_kerja', 'sabtu_masuk', 'minggu_masuk', 'jenis', 'created_by', 'updated_by'], 'integer'],
            [['nama_jam_kerja', 'keterangan', 'jam_masuk', 'jam_istirahat', 'jam_pulang', 'created_at', 'updated_at'], 'safe'],
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
        $query = MasterJamKerja::find();

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
            'id_jam_kerja' => $this->id_jam_kerja,
            'jam_masuk' => $this->jam_masuk,
            'jam_istirahat' => $this->jam_istirahat,
            'jam_pulang' => $this->jam_pulang,
            'sabtu_masuk' => $this->sabtu_masuk,
            'minggu_masuk' => $this->minggu_masuk,
            'jenis' => $this->jenis,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_jam_kerja', $this->nama_jam_kerja])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
