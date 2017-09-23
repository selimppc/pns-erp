<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwImStockView extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_im_stock_view}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product id'),
            'product_code' => Yii::t('app', 'Product Code'),
            'product_title'  => Yii::t('app', 'Product Title'),
            'batch_number' => Yii::t('app', 'Batch Number'),
            'expire_date' => Yii::t('app', 'Expire Date'),
            'branch_id' => Yii::t('app','Branch'),
            'sell_rate'> Yii::t('app', 'Sell Rate'),
            'sell_tax' => Yii::t('app','Sell Tax'),
            'im_rate' => Yii::t('app', 'Rate'),
            'uom' => Yii::t('app', 'UOM'),
            'issueQty' => Yii::t('app', 'Issue Qty'),
            'saleQty' => Yii::t('app', 'Sale Qty'),
            'inhandQty' => Yii::t('app', 'In Hand Qty'),
            'available' => Yii::t('app','Available'),
            'min_level' => Yii::t('app','Min Level')
        ];
    }


    public static function get_product_list() {
        $options = [];
        $product_q = VwImStockView::find()->all();
        
        if(!empty($product_q)){
            foreach ($product_q as $key => $value) {
                $options[$value->product_id] = $value->product_title .' :: '.$value->product_code;

            }
        }        

        return $options;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUom()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'uom']);
    }

    
}

