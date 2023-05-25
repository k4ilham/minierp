<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_tunjangan_jabatan".
 *
 * @property int $id_tunjangan_jabatan
 * @property int $id_karyawan
 * @property string $tgl
 * @property int $aktif
 * @property float $nominal
 * @property string $keterangan
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransTunjanganJabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_tunjangan_jabatan';
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
            [['id_karyawan', 'tgl', 'aktif', 'nominal', 'keterangan'], 'required'],
            [['id_karyawan', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['tgl', 'created_at', 'updated_at'], 'safe'],
            [['nominal'], 'number'],
            [['keterangan'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tunjangan_jabatan' => 'Id Tunjangan Jabatan',
            'id_karyawan' => 'Id Karyawan',
            'tgl' => 'Tgl',
            'aktif' => 'Aktif',
            'nominal' => 'Nominal',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
