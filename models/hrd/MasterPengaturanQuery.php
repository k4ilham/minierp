<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[MasterPengaturan]].
 *
 * @see MasterPengaturan
 */
class MasterPengaturanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MasterPengaturan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MasterPengaturan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
