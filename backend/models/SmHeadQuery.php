<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[SmHead]].
 *
 * @see SmHead
 */
class SmHeadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SmHead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmHead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
