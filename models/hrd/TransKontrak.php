<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_kontrak".
 *
 * @property int $id_kontrak
 * @property int $id_karyawan
 * @property int $periode_kontrak
 * @property int $bulan_kontrak
 * @property string $mulai_kontrak
 * @property string $akhir_kontrak
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransKontrak extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_kontrak';
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
            [['id_karyawan', 'periode_kontrak', 'bulan_kontrak', 'created_by', 'updated_by'], 'integer'],
            [['periode_kontrak', 'bulan_kontrak', 'mulai_kontrak', 'akhir_kontrak'], 'required'],
            [['mulai_kontrak', 'akhir_kontrak', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kontrak' => 'Id Kontrak',
            'id_karyawan' => 'Id Karyawan',
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
     * @return TransKontrakQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransKontrakQuery(get_called_class());
    }
}
