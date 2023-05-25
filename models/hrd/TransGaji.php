<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_gaji".
 *
 * @property int $id_gaji
 * @property string $periode
 * @property int $id_karyawan
 * @property int $id_departemen
 * @property int $id_jabatan
 * @property int $id_status
 * @property int $id_bank
 * @property int $menikah
 * @property int $jml_anak
 * @property int $jml_tanggungan
 * @property int $potong_bpjstk
 * @property int $potong_bpjskes
 * @property int $potong_pensiun
 * @property string $norek
 * @property string $atasnama
 * @property string $cabangbank
 * @property string $kotabank
 * @property float $gapok
 * @property float $jml_hadir
 * @property float $uang_kehadiran
 * @property float $uang_lembur
 * @property float $gaji_kotor
 * @property float $tunj_masakerja
 * @property float $tunj_jabatan
 * @property float $tunj_keahlian
 * @property float $tunj_lain
 * @property float $pot_koperasi
 * @property float $pot_kedisplinan
 * @property float $pot_lain
 * @property float $total_tunjangan
 * @property float $total_potongan
 * @property float $gaji_bersih
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransGaji extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_gaji';
    }

    public function behaviors(){ 
        return [        
            [            
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),        
            ], 
            [            
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by'       
            ],   
        ];   
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['periode', 'id_karyawan', 'id_departemen', 'id_jabatan', 'id_status', 'id_bank', 'menikah', 'jml_anak', 'jml_tanggungan', 'potong_bpjstk', 'potong_bpjskes', 'potong_pensiun', 'norek', 'atasnama', 'cabangbank', 'kotabank', 'gapok', 'jml_hadir', 'uang_kehadiran', 'uang_lembur', 'gaji_kotor', 'tunj_masakerja', 'tunj_jabatan', 'tunj_keahlian', 'tunj_lain', 'pot_koperasi', 'pot_kedisplinan', 'pot_lain', 'total_tunjangan', 'total_potongan', 'gaji_bersih'], 'required'],
            [['id_karyawan', 'id_departemen', 'id_jabatan', 'id_status', 'id_bank', 'menikah', 'jml_anak', 'jml_tanggungan', 'potong_bpjstk', 'potong_bpjskes', 'potong_pensiun', 'created_by', 'updated_by'], 'integer'],
            [['gapok', 'jml_hadir', 'uang_kehadiran', 'uang_lembur', 'gaji_kotor', 'tunj_masakerja', 'tunj_jabatan', 'tunj_keahlian', 'tunj_lain', 'pot_koperasi', 'pot_kedisplinan', 'pot_lain','bpjstk','bpjskes','pensiun','total1','total2' ,'total_pendapatan', 'total_potongan', 'gaji_bersih'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['periode'], 'string', 'max' => 7],
            [['norek', 'atasnama', 'cabangbank', 'kotabank'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_gaji' => 'Id Gaji',
            'periode' => 'Periode',
            'id_karyawan' => 'Id Karyawan',
            'id_departemen' => 'Id Departemen',
            'id_jabatan' => 'Id Jabatan',
            'id_status' => 'Id Status',
            'id_bank' => 'Id Bank',
            'menikah' => 'Menikah',
            'jml_anak' => 'Jml Anak',
            'jml_tanggungan' => 'Jml Tanggungan',
            'potong_bpjstk' => 'Potong Bpjstk',
            'potong_bpjskes' => 'Potong Bpjskes',
            'potong_pensiun' => 'Potong Pensiun',
            'norek' => 'Norek',
            'atasnama' => 'Atasnama',
            'cabangbank' => 'Cabangbank',
            'kotabank' => 'Kotabank',
            'gapok' => 'Gapok',
            'jml_hadir' => 'Jml Hadir',
            'uang_kehadiran' => 'Uang Kehadiran',
            'uang_lembur' => 'Uang Lembur',
            'gaji_kotor' => 'Gaji Kotor',
            'tunj_masakerja' => 'Tunj Masakerja',
            'tunj_jabatan' => 'Tunj Jabatan',
            'tunj_keahlian' => 'Tunj Keahlian',
            'tunj_lain' => 'Tunj Lain',
            'pot_koperasi' => 'Pot Koperasi',
            'pot_kedisplinan' => 'Pot Kedisplinan',
            'pot_lain' => 'Pot Lain',
            'total_tunjangan' => 'Total Tunjangan',
            'total_potongan' => 'Total Potongan',
            'gaji_bersih' => 'Gaji Bersih',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransGajiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransGajiQuery(get_called_class());
    }
}
