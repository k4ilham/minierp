<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_ijin".
 *
 * @property int $id_ijin
 * @property int $id_karyawan
 * @property string $periode
 * @property string $tgl_ijin
 * @property string $keterangan
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransIjin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_ijin';
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
            [['id_karyawan', 'periode', 'tgl_ijin', 'keterangan'], 'required'],
            [['id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['tgl_ijin', 'created_at', 'updated_at'], 'safe'],
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
            'id_ijin' => 'Id Ijin',
            'id_karyawan' => 'Id Karyawan',
            'periode' => 'Periode',
            'tgl_ijin' => 'Tgl Ijin',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
