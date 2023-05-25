<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransOff]].
 *
 * @see TransOff
 */
class TransOffQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransOff[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransOff|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
