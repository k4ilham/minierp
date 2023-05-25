<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_periode".
 *
 * @property int $id_periode
 * @property string|null $periode
 * @property int|null $aktif
 * @property string|null $tgl_gaji
 * @property string|null $tgl_absen_awal
 * @property string|null $tgl_absen_akhir
 * @property string|null $tgl_posting
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Transperiode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_periode';
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
            [['periode'], 'required'],
            [['aktif', 'created_by', 'updated_by'], 'integer'],
            [['tgl_gaji', 'tgl_absen_awal', 'tgl_absen_akhir', 'tgl_posting', 'created_at', 'updated_at'], 'safe'],
            [['periode'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_periode' => 'Id Periode',
            'periode' => 'Periode',
            'aktif' => 'Aktif',
            'tgl_gaji' => 'Tgl Gaji',
            'tgl_absen_awal' => 'Tgl Absen Awal',
            'tgl_absen_akhir' => 'Tgl Absen Akhir',
            'tgl_posting' => 'Tgl Posting',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
