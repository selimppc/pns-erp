<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ImGrnDetail]].
 *
 * @see ImGrnDetail
 */
class ImGrnDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ImGrnDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ImGrnDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
