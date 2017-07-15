<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PpPurchaseDetail]].
 *
 * @see PpPurchaseDetail
 */
class PpPurchaseDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PpPurchaseDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PpPurchaseDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
