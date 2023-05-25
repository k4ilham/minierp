<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_photo".
 *
 * @property int $user_id
 * @property string|null $photo
 */
class UserPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'photo'], 'required'],
            [['user_id'], 'integer'],
            [['photo'], 'file', 'extensions' => ['png', 'jpg','gif'], 'maxSize' => 1024*1024]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'photo' => 'Photo',
        ];
    }
}
