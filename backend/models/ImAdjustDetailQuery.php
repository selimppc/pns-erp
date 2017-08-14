<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ImAdjustDetail]].
 *
 * @see ImAdjustDetail
 */
class ImAdjustDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ImAdjustDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ImAdjustDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
