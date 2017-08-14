<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[GroupFour]].
 *
 * @see GroupFour
 */
class GroupFourQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GroupFour[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GroupFour|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
