<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransAbsensiManual]].
 *
 * @see TransAbsensiManual
 */
class TransAbsensiManualQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransAbsensiManual[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransAbsensiManual|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
