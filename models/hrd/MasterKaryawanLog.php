<?php

namespace app\models\hrd;

use Yii;

/**
 * This is the model class for table "master_karyawan_log".
 *
 * @property int $id_karyawan_log
 * @property int $id_karyawan
 * @property string $log
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterKaryawanLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_karyawan_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_karyawan', 'log'], 'required'],
            [['id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['log'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_karyawan_log' => 'Id Karyawan Log',
            'id_karyawan' => 'Id Karyawan',
            'log' => 'Log',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
