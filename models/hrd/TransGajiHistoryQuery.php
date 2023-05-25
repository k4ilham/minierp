<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[TransGajiHistory]].
 *
 * @see TransGajiHistory
 */
class TransGajiHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TransGajiHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TransGajiHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
