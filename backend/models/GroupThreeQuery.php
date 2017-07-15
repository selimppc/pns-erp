<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[GroupThree]].
 *
 * @see GroupThree
 */
class GroupThreeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GroupThree[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GroupThree|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
