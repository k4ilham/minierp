<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "trans_absensi_manual".
 *
 * @property int $id_absensi_manual
 * @property int $id_karyawan
 * @property int|null $id_jam_kerja
 * @property string|null $periode
 * @property string|null $tgl_absen
 * @property string|null $in
 * @property string|null $out
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransAbsensiManual extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_absensi_manual';
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
            [['id_karyawan'], 'required'],
            [['id_karyawan', 'id_jam_kerja', 'status', 'created_by', 'updated_by'], 'integer'],
            [['tgl_absen', 'created_at', 'updated_at'], 'safe'],
            [['periode'], 'string', 'max' => 7],
            [['in', 'out'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_absensi_manual' => 'Id Absensi Manual',
            'id_karyawan' => 'Id Karyawan',
            'id_jam_kerja' => 'Id Jam Kerja',
            'periode' => 'Periode',
            'tgl_absen' => 'Tgl Absen',
            'in' => 'In',
            'out' => 'Out',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransAbsensiManualQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransAbsensiManualQuery(get_called_class());
    }
}
