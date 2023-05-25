<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransLibur]].
 *
 * @see TransLibur
 */
class TransLiburQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransLibur[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransLibur|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
