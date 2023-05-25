<?php

namespace app\models\hrd;

/**
 * This is the ActiveQuery class for [[MasterKaryawanTemp]].
 *
 * @see MasterKaryawanTemp
 */
class MasterKaryawanTempQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MasterKaryawanTemp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MasterKaryawanTemp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
