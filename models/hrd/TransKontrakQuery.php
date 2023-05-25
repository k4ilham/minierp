<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransKontrak]].
 *
 * @see TransKontrak
 */
class TransKontrakQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransKontrak[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransKontrak|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
