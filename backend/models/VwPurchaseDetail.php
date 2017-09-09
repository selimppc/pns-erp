<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwPurchaseDetail extends \yii\db\ActiveRecord
{

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_purchase_detail}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUomData()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'uom']);
    }

}