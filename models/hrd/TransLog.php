<?php

namespace app\models\hrd;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "trans_log".
 *
 * @property int $id_log
 * @property string|null $timelog
 * @property string|null $desc
 * @property int|null $id_user
 * @property string|null $userIP
 * @property string|null $scriptUrl
 * @property string|null $scriptFile
 * @property string|null $pathInfo
 * @property string|null $port
 * @property string|null $method
 * @property string|null $origin
 * @property string|null $userAgent
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_log';
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
            [['timelog', 'created_at', 'updated_at'], 'safe'],
            [['id_user', 'created_by', 'updated_by'], 'integer'],
            [['userAgent'], 'string'],
            [['desc'], 'string', 'max' => 100],
            [['userIP', 'scriptUrl', 'scriptFile', 'pathInfo', 'port', 'method', 'origin'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_log' => 'Id Log',
            'timelog' => 'Timelog',
            'desc' => 'Desc',
            'id_user' => 'Id User',
            'userIP' => 'User Ip',
            'scriptUrl' => 'Script Url',
            'scriptFile' => 'Script File',
            'pathInfo' => 'Path Info',
            'port' => 'Port',
            'method' => 'Method',
            'origin' => 'Origin',
            'userAgent' => 'User Agent',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
