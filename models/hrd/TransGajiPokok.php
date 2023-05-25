<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_gaji_pokok".
 *
 * @property int $id_gaji_pokok
 * @property int $id_karyawan
 * @property string $tgl_gaji
 * @property float $nominal
 * @property string $keterangan
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransGajiPokok extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_gaji_pokok';
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
            [['id_karyawan', 'tgl_gaji', 'nominal', 'keterangan'], 'required'],
            [['id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['tgl_gaji', 'created_at', 'updated_at'], 'safe'],
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
            'id_gaji_pokok' => 'Id Gaji Pokok',
            'id_karyawan' => 'Id Karyawan',
            'tgl_gaji' => 'Tgl Gaji',
            'nominal' => 'Nominal',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
