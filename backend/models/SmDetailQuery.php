<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[SmDetail]].
 *
 * @see SmDetail
 */
class SmDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SmDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
