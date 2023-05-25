<?php

namespace app\models\hrd;

use Yii;

/**
 * This is the model class for table "trans_koreksi".
 *
 * @property int $id_koreksi
 * @property int $id_karyawan
 * @property string $tgl
 * @property string $keterangan
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TransKoreksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trans_koreksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_karyawan', 'tgl', 'keterangan'], 'required'],
            [['id_karyawan', 'created_by', 'updated_by'], 'integer'],
            [['tgl', 'created_at', 'updated_at'], 'safe'],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_koreksi' => 'Id Koreksi',
            'id_karyawan' => 'Id Karyawan',
            'tgl' => 'Tgl',
            'keterangan' => 'Keterangan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TransKoreksiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransKoreksiQuery(get_called_class());
    }
}
