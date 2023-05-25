<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\MasterJabatan;

/**
 * MasterJabatanSearch represents the model behind the search form of `app\models\hrd\MasterJabatan`.
 */
class MasterJabatanSearch extends MasterJabatan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_jabatan', 'created_by', 'updated_by'], 'integer'],
            [['nama_jabatan', 'created_at', 'updated_at'], 'safe'],
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
        $query = MasterJabatan::find();

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
            'id_jabatan' => $this->id_jabatan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nama_jabatan', $this->nama_jabatan]);

        return $dataProvider;
    }
}
