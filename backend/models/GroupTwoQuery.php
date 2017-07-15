<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[GroupTwo]].
 *
 * @see GroupTwo
 */
class GroupTwoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GroupTwo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GroupTwo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
