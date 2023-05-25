<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransCutiKhusus]].
 *
 * @see TransCutiKhusus
 */
class TransCutiKhususQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransCutiKhusus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransCutiKhusus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
