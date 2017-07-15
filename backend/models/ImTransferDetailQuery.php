<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ImTransferDetail]].
 *
 * @see ImTransferDetail
 */
class ImTransferDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ImTransferDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ImTransferDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
