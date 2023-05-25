<?php

namespace app\models\hrd;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\hrd\TransGaji;

/**
 * TransGajiSearch represents the model behind the search form of `app\models\hrd\TransGaji`.
 */
class TransGajiSearch extends TransGaji
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_gaji', 'id_karyawan', 'id_departemen', 'id_jabatan', 'id_status', 'id_bank', 'menikah', 'jml_anak', 'jml_tanggungan', 'potong_bpjstk', 'potong_bpjskes', 'potong_pensiun', 'created_by', 'updated_by'], 'integer'],
            [['periode', 'norek', 'atasnama', 'cabangbank', 'kotabank', 'created_at', 'updated_at'], 'safe'],
            [['gapok', 'jml_hadir', 'uang_kehadiran', 'uang_lembur', 'gaji_kotor', 'tunj_masakerja', 'tunj_jabatan', 'tunj_keahlian', 'tunj_lain', 'pot_koperasi', 'pot_kedisplinan', 'pot_lain', 'total_tunjangan', 'total_potongan', 'gaji_bersih'], 'number'],
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
        $query = TransGaji::find();

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
            'id_gaji' => $this->id_gaji,
            'id_karyawan' => $this->id_karyawan,
            'id_departemen' => $this->id_departemen,
            'id_jabatan' => $this->id_jabatan,
            'id_status' => $this->id_status,
            'id_bank' => $this->id_bank,
            'menikah' => $this->menikah,
            'jml_anak' => $this->jml_anak,
            'jml_tanggungan' => $this->jml_tanggungan,
            'potong_bpjstk' => $this->potong_bpjstk,
            'potong_bpjskes' => $this->potong_bpjskes,
            'potong_pensiun' => $this->potong_pensiun,
            'gapok' => $this->gapok,
            'jml_hadir' => $this->jml_hadir,
            'uang_kehadiran' => $this->uang_kehadiran,
            'uang_lembur' => $this->uang_lembur,
            'gaji_kotor' => $this->gaji_kotor,
            'tunj_masakerja' => $this->tunj_masakerja,
            'tunj_jabatan' => $this->tunj_jabatan,
            'tunj_keahlian' => $this->tunj_keahlian,
            'tunj_lain' => $this->tunj_lain,
            'pot_koperasi' => $this->pot_koperasi,
            'pot_kedisplinan' => $this->pot_kedisplinan,
            'pot_lain' => $this->pot_lain,
            'total_tunjangan' => $this->total_tunjangan,
            'total_potongan' => $this->total_potongan,
            'gaji_bersih' => $this->gaji_bersih,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode])
            ->andFilterWhere(['like', 'norek', $this->norek])
            ->andFilterWhere(['like', 'atasnama', $this->atasnama])
            ->andFilterWhere(['like', 'cabangbank', $this->cabangbank])
            ->andFilterWhere(['like', 'kotabank', $this->kotabank]);

        return $dataProvider;
    }
}
