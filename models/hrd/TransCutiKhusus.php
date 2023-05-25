<?php

namespace app\models\hrd;

use Yii;

/**
 * This is the model class for table "trans_cuti_khusus".
 *
 * @property int $id_cuti_khusus
 * @property int $id_karyawan
 * @property string $jenis_cuti
 * @property string $periode
 * @property string $tgl_awal
 * @property string $tgl_akhir
 * @property int $jml_hari
 * @property int|null $saldo_cuti
 * @property int|null $saldo_cuti_lalu
 * @property int|null $potong_cuti
 * @property string|null $keterangan
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransCutiKhusus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_cuti_khusus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_karyawan', 'jenis_cuti', 'periode', 'tgl_awal', 'tgl_akhir', 'jml_hari'], 'required'],
            [['id_karyawan', 'jml_hari', 'saldo_cuti', 'saldo_cuti_lalu', 'potong_cuti', 'created_by', 'updated_by'], 'integer'],
            [['tgl_awal', 'tgl_akhir', 'created_at', 'updated_at'], 'safe'],
            [['jenis_cuti', 'keterangan'], 'string', 'max' => 50],
            [['periode'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cuti_khusus' => 'Id Cuti Khusus',
            'id_karyawan' => 'Id Karyawan',
            'jenis_cuti' => 'Jenis Cuti',
            'periode' => 'Periode',
            'tgl_awal' => 'Tgl Awal',
            'tgl_akhir' => 'Tgl Akhir',
            'jml_hari' => 'Jml Hari',
            'saldo_cuti' => 'Saldo Cuti',
            'saldo_cuti_lalu' => 'Saldo Cuti Lalu',
            'potong_cuti' => 'Potong Cuti',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransCutiKhususQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransCutiKhususQuery(get_called_class());
    }
}
