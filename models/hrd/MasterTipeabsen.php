<?php

namespace app\models\hrd;

use Yii;

/**
 * This is the model class for table "master_tipeabsen".
 *
 * @property int $id_tipeabsen
 * @property string $tipeabsen
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class MasterTipeabsen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_tipeabsen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipeabsen'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['tipeabsen'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipeabsen' => 'Id Tipeabsen',
            'tipeabsen' => 'Tipeabsen',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MasterTipeabsenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MasterTipeabsenQuery(get_called_class());
    }
}
