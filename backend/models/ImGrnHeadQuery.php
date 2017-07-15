<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ImGrnHead]].
 *
 * @see ImGrnHead
 */
class ImGrnHeadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ImGrnHead[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ImGrnHead|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
