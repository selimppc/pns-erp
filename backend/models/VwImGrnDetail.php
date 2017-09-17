<?php
namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwImGrnDetail extends \yii\db\ActiveRecord{

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_im_grn_detail}}';
    }


      /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUom()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}