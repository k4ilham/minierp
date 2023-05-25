<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransSakit]].
 *
 * @see TransSakit
 */
class TransSakitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransSakit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransSakit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
