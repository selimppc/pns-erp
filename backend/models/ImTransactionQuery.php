<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ImTransaction]].
 *
 * @see ImTransaction
 */
class ImTransactionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ImTransaction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ImTransaction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
