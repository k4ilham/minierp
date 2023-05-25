<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "master_karyawan_temp".
 *
 * @property int $id_karyawan
 * @property string|null $nik
 * @property string|null $nama_karyawan
 * @property float|null $gapok
 * @property int|null $status_uang_kehadiran
 * @property float|null $rate_kehadiran
 * @property int|null $saldo_cuti
 * @property string|null $exp_cuti
 * @property int|null $saldo_cuti_lalu
 * @property string|null $exp_cuti_lalu
 * @property int|null $aktif
 * @property int|null $id_departemen
 * @property int|null $id_divisi
 * @property int|null $id_group
 * @property int|null $id_jabatan
 * @property int|null $id_status
 * @property int|null $id_lokasi
 * @property int|null $id_cabang
 * @property int|null $id_jam_kerja
 * @property int|null $jk
 * @property int|null $menikah
 * @property int|null $jml_anak
 * @property int|null $jml_tanggungan
 * @property string|null $ibu_kandung
 * @property string|null $tempat_lahir
 * @property string|null $tgl_lahir
 * @property string|null $tgl_masuk
 * @property string|null $tgl_tetap
 * @property string|null $tgl_keluar
 * @property string|null $kk
 * @property string|null $ktp
 * @property string|null $alamat_ktp
 * @property string|null $kota
 * @property string|null $alamat_tinggal
 * @property string|null $pendidikan
 * @property string|null $agama
 * @property string|null $goldarah
 * @property string|null $nohp1
 * @property string|null $nohp2
 * @property string|null $email
 * @property string|null $bpjstk
 * @property string|null $bpjskes
 * @property string|null $npwp
 * @property string|null $telegram
 * @property string|null $norek
 * @property string|null $atasnama
 * @property int|null $id_bank
 * @property string|null $kotabank
 * @property string|null $cabangbank
 * @property int|null $periode_kontrak
 * @property int|null $bulan_kontrak
 * @property string|null $mulai_kontrak
 * @property string|null $akhir_kontrak
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterKaryawanTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_karyawan_temp';
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
            [['gapok', 'rate_kehadiran'], 'number'],
            [['status_uang_kehadiran', 'saldo_cuti', 'saldo_cuti_lalu', 'aktif', 'id_departemen', 'id_divisi', 'id_group', 'id_jabatan', 'id_status', 'id_lokasi', 'id_cabang', 'id_jam_kerja', 'jk', 'menikah', 'jml_anak', 'jml_tanggungan', 'id_bank', 'periode_kontrak', 'bulan_kontrak', 'created_by', 'updated_by'], 'integer'],
            [['exp_cuti', 'exp_cuti_lalu', 'tgl_lahir', 'tgl_masuk', 'tgl_tetap', 'tgl_keluar', 'mulai_kontrak', 'akhir_kontrak', 'created_at', 'updated_at'], 'safe'],
            [['alamat_ktp', 'alamat_tinggal'], 'string'],
            [['nik', 'ibu_kandung', 'tempat_lahir', 'kk', 'ktp', 'kota', 'pendidikan', 'agama', 'goldarah', 'nohp1', 'nohp2', 'email', 'bpjstk', 'bpjskes', 'npwp', 'telegram', 'norek', 'atasnama', 'kotabank', 'cabangbank'], 'string', 'max' => 50],
            [['nama_karyawan'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_karyawan' => 'Id Karyawan',
            'nik' => 'Nik',
            'nama_karyawan' => 'Nama Karyawan',
            'gapok' => 'Gapok',
            'status_uang_kehadiran' => 'Status Uang Kehadiran',
            'rate_kehadiran' => 'Rate Kehadiran',
            'saldo_cuti' => 'Saldo Cuti',
            'exp_cuti' => 'Exp Cuti',
            'saldo_cuti_lalu' => 'Saldo Cuti Lalu',
            'exp_cuti_lalu' => 'Exp Cuti Lalu',
            'aktif' => 'Aktif',
            'id_departemen' => 'Id Departemen',
            'id_divisi' => 'Id Divisi',
            'id_group' => 'Id Group',
            'id_jabatan' => 'Id Jabatan',
            'id_status' => 'Id Status',
            'id_lokasi' => 'Id Lokasi',
            'id_cabang' => 'Id Cabang',
            'id_jam_kerja' => 'Id Jam Kerja',
            'jk' => 'Jk',
            'menikah' => 'Menikah',
            'jml_anak' => 'Jml Anak',
            'jml_tanggungan' => 'Jml Tanggungan',
            'ibu_kandung' => 'Ibu Kandung',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'tgl_masuk' => 'Tgl Masuk',
            'tgl_tetap' => 'Tgl Tetap',
            'tgl_keluar' => 'Tgl Keluar',
            'kk' => 'Kk',
            'ktp' => 'Ktp',
            'alamat_ktp' => 'Alamat Ktp',
            'kota' => 'Kota',
            'alamat_tinggal' => 'Alamat Tinggal',
            'pendidikan' => 'Pendidikan',
            'agama' => 'Agama',
            'goldarah' => 'Goldarah',
            'nohp1' => 'Nohp1',
            'nohp2' => 'Nohp2',
            'email' => 'Email',
            'bpjstk' => 'Bpjstk',
            'bpjskes' => 'Bpjskes',
            'npwp' => 'Npwp',
            'telegram' => 'Telegram',
            'norek' => 'Norek',
            'atasnama' => 'Atasnama',
            'id_bank' => 'Id Bank',
            'kotabank' => 'Kotabank',
            'cabangbank' => 'Cabangbank',
            'periode_kontrak' => 'Periode Kontrak',
            'bulan_kontrak' => 'Bulan Kontrak',
            'mulai_kontrak' => 'Mulai Kontrak',
            'akhir_kontrak' => 'Akhir Kontrak',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MasterKaryawanTempQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MasterKaryawanTempQuery(get_called_class());
    }
}
