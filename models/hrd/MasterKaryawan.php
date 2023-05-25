<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "master_karyawan".
 *
 * @property int $id_karyawan
 * @property string|null $nik
 * @property string|null $nama_karyawan
 * @property int|null $id_departemen
 * @property int|null $id_divisi
 * @property int|null $id_jabatan
 * @property int|null $id_status
 * @property int|null $id_jam_kerja
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterKaryawan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_karyawan';
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
            [['id_departemen', 'id_divisi', 'id_jabatan', 'id_status','aktif','id_lokasi','jk','menikah',
            'jml_anak','jml_tanggungan', 'id_jam_kerja', 'created_by', 'updated_by','id_bank','bulan_kontrak','periode_kontrak'
            ,'status_uang_kehadiran','id_group','saldo_cuti','saldo_cuti_lalu'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['gapok','rate_kehadiran'], 'number'],
            [['nik','tempat_lahir','tgl_lahir','ibu_kandung','tgl_masuk','tgl_tetap','tgl_keluar','kk','ktp','alamat_ktp','kota',
            'alamat_tinggal','pendidikan','agama','goldarah','nohp1','nohp2','email','bpjstk','bpjskes','npwp','telegram',
            'norek','atasnama','kotabank','cabangbank','mulai_kontrak','akhir_kontrak'], 'string', 'max' => 1000],
            [['nama_karyawan'], 'string', 'max' => 1000],
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
            'aktif' => 'Aktif',
            'nama_karyawan' => 'Nama Karyawan',
            'id_departemen' => 'Id Departemen',
            'id_divisi' => 'Id Divisi',
            'id_jabatan' => 'Id Jabatan',
            'id_status' => 'Id Status',
            'id_lokasi' => 'Id Lokasi',
            'id_jam_kerja' => 'Id Jam Kerja',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
