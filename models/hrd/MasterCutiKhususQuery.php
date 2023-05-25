<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[MasterCutiKhusus]].
 *
 * @see MasterCutiKhusus
 */
class MasterCutiKhususQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MasterCutiKhusus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MasterCutiKhusus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
