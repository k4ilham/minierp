<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\MasterKaryawan;


/**
 * MasterKaryawanSearch represents the model behind the search form of `app\models\hrd\MasterKaryawan`.
 */
class MasterKaryawanSearch extends MasterKaryawan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_karyawan', 'id_departemen', 'id_divisi', 'id_jabatan', 'id_status', 'id_jam_kerja', 'created_by', 'updated_by'], 'integer'],
            [['nik', 'nama_karyawan', 'created_at', 'updated_at'], 'safe'],
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
        $query = MasterKaryawan::find();

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
            'id_karyawan' => $this->id_karyawan,
            'id_departemen' => $this->id_departemen,
            'id_divisi' => $this->id_divisi,
            'id_jabatan' => $this->id_jabatan,
            'id_status' => $this->id_status,
            'id_jam_kerja' => $this->id_jam_kerja,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'nama_karyawan', $this->nama_karyawan]);

        return $dataProvider;
    }
}
