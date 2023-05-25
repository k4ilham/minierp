<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_lembur".
 *
 * @property int $id_lembur
 * @property int $id_karyawan
 * @property string $periode
 * @property string $tgl_lembur
 * @property string $jam_mulai
 * @property string $jam_selesai
 * @property string $durasi
 * @property string $jam_lembur
 * @property float $uang_lembur
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransLembur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_lembur';
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
            [['id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['uang_lembur'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['periode'], 'string', 'max' => 7],
            [['tgl_lembur', 'jam_mulai', 'jam_selesai','jam_istirahat', 'durasi','index_lembur','rate', 'jam_lembur','jh'], 'string', 'max' => 1000],
        ];
    }
 
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lembur' => 'Id Lembur',
            'jh' => 'Jenis Hari',
            'id_karyawan' => 'Id Karyawan',
            'periode' => 'Periode',
            'tgl_lembur' => 'Tgl Lembur',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'durasi' => 'Durasi',
            'jam_lembur' => 'Jam Lembur',
            'uang_lembur' => 'Uang Lembur',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
