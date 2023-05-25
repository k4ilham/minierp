<?php

namespace app\models\hrd;

use Yii;

/**
 * This is the model class for table "master_kalender".
 *
 * @property int $id_kalender
 * @property string $tgl
 * @property int $hari
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterKalender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_kalender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl', 'hari'], 'required'],
            [['tgl', 'created_at', 'updated_at'], 'safe'],
            [['hari', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kalender' => 'Id Kalender',
            'tgl' => 'Tgl',
            'hari' => 'Hari',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
