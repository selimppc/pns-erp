<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[AmCoa]].
 *
 * @see AmCoa
 */
class AmCoaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AmCoa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AmCoa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
