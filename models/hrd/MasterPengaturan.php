<?php

namespace app\models\hrd;

use Yii;

/**
 * This is the model class for table "master_pengaturan".
 *
 * @property int $id_pengaturan
 * @property string|null $perusahaan
 * @property string|null $akronim
 * @property string|null $alamat
 * @property string|null $telp
 * @property float|null $umr
 * @property float|null $max_bpjskes
 * @property float|null $umur_pensiun
 * @property float|null $max_pensiun
 * @property float|null $persen_bpjskes_kar
 * @property float|null $persen_bpjskes_per
 * @property float|null $persen_bpjskes_total
 * @property float|null $persen_bpjstk_kar
 * @property float|null $persen_bpjstk_per
 * @property float|null $persen_bpjstk_total
 * @property float|null $persen_pensiun_kar
 * @property float|null $persen_pensiun_per
 * @property float|null $persen_pensiun_total
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterPengaturan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_pengaturan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat'], 'string'],
            [['umr', 'max_bpjskes', 'umur_pensiun', 'max_pensiun', 'persen_bpjskes_kar', 'persen_bpjskes_per', 'persen_bpjskes_total', 'persen_bpjstk_kar', 'persen_bpjstk_per', 'persen_bpjstk_total', 'persen_pensiun_kar', 'persen_pensiun_per', 'persen_pensiun_total'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['perusahaan', 'akronim', 'telp'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pengaturan' => 'Id Pengaturan',
            'perusahaan' => 'Perusahaan',
            'akronim' => 'Akronim',
            'alamat' => 'Alamat',
            'telp' => 'Telp',
            'umr' => 'Umr',
            'max_bpjskes' => 'Max Bpjskes',
            'umur_pensiun' => 'Umur Pensiun',
            'max_pensiun' => 'Max Pensiun',
            'persen_bpjskes_kar' => 'Persen Bpjskes Kar',
            'persen_bpjskes_per' => 'Persen Bpjskes Per',
            'persen_bpjskes_total' => 'Persen Bpjskes Total',
            'persen_bpjstk_kar' => 'Persen Bpjstk Kar',
            'persen_bpjstk_per' => 'Persen Bpjstk Per',
            'persen_bpjstk_total' => 'Persen Bpjstk Total',
            'persen_pensiun_kar' => 'Persen Pensiun Kar',
            'persen_pensiun_per' => 'Persen Pensiun Per',
            'persen_pensiun_total' => 'Persen Pensiun Total',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MasterPengaturanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MasterPengaturanQuery(get_called_class());
    }
}
