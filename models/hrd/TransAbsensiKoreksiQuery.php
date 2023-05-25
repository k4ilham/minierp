<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransAbsensiKoreksi]].
 *
 * @see TransAbsensiKoreksi
 */
class TransAbsensiKoreksiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransAbsensiKoreksi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransAbsensiKoreksi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
