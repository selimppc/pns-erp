<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[CodesParam]].
 *
 * @see CodesParam
 */
class CodesParamQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CodesParam[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CodesParam|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
