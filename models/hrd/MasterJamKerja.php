<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "master_jam_kerja".
 *
 * @property int $id_jam_kerja
 * @property string|null $nama_jam_kerja
 * @property string|null $keterangan
 * @property string|null $jam_masuk
 * @property string|null $jam_istirahat
 * @property string|null $jam_pulang
 * @property int|null $sabtu_masuk
 * @property int|null $minggu_masuk
 * @property int|null $jenis
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterJamKerja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_jam_kerja';
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
            [['jam_masuk', 'jam_istirahat', 'jam_pulang', 'created_at', 'updated_at'], 'safe'],
            [['sabtu_masuk', 'minggu_masuk', 'jenis', 'created_by', 'updated_by'], 'integer'],
            [['nama_jam_kerja', 'keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jam_kerja' => 'Id Jam Kerja',
            'nama_jam_kerja' => 'Nama Jam Kerja',
            'keterangan' => 'Keterangan',
            'jam_masuk' => 'Jam Masuk',
            'jam_istirahat' => 'Jam Istirahat',
            'jam_pulang' => 'Jam Pulang',
            'sabtu_masuk' => 'Sabtu Masuk',
            'minggu_masuk' => 'Minggu Masuk',
            'jenis' => 'Jenis',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
