<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransCuti]].
 *
 * @see TransCuti
 */
class TransCutiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransCuti[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransCuti|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
