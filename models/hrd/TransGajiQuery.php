<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransGaji]].
 *
 * @see TransGaji
 */
class TransGajiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransGaji[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransGaji|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
