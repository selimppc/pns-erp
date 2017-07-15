<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PpPurchaseHead]].
 *
 * @see PpPurchaseHead
 */
class PpPurchaseHeadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PpPurchaseHead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PpPurchaseHead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
