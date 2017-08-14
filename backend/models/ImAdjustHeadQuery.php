<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ImAdjustHead]].
 *
 * @see ImAdjustHead
 */
class ImAdjustHeadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ImAdjustHead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ImAdjustHead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
