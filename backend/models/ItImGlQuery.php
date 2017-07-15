<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ItImGl]].
 *
 * @see ItImGl
 */
class ItImGlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ItImGl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItImGl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
