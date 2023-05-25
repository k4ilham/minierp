<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_potongan_kedisplinan".
 *
 * @property int $id_potongan_kedisplinan
 * @property int $id_karyawan
 * @property string $tgl
 * @property string $periode
 * @property int $aktif
 * @property float $nominal
 * @property string $keterangan
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransPotonganKedisplinan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_potongan_kedisplinan';
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
            [['id_karyawan', 'tgl', 'periode', 'aktif', 'nominal', 'keterangan'], 'required'],
            [['id_karyawan', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['tgl', 'created_at', 'updated_at'], 'safe'],
            [['nominal'], 'number'],
            [['keterangan'], 'string'],
            [['periode'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_potongan_kedisplinan' => 'Id Potongan Kedisplinan',
            'id_karyawan' => 'Id Karyawan',
            'tgl' => 'Tgl',
            'periode' => 'Periode',
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
