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

        //$branch = $_GET[‘branch’]; // TODO::
        $date = date('Y-m-d');

        $product_q = VwImStockView::find()->where(['>=','expire_date',$date])->all();
        
        if(!empty($product_q)){
            foreach ($product_q as $key => $value) {
                $options[$value->product_id] = $value->product_title .' :: '.$value->product_code. ' :: '.$value->product->model ;

            }
        }        

        return $options;
    }


    public static function total_qty_branch($branch_id='')
    {
        $branch_qty = Yii::$app->db->createCommand("SELECT SUM([[available]]) FROM {{vw_im_stock_view}} WHERE branch_id = '$branch_id'")
            ->queryScalar();

        return $branch_qty;    
    }

    public static function get_product_list_dpends_branch($branch_id) {
        $options = [];

        //$branch = $_GET[‘branch’]; // TODO::
        $date = date('Y-m-d');

        $product_q = VwImStockView::find()->where(['branch_id'=>$branch_id])->andWhere(['>=','expire_date',$date])->all();
        
        if(!empty($product_q)){
            foreach ($product_q as $key => $value) {
                $options[$value->product_id] = $value->product_title .' :: '.$value->product_code. ' :: '.$value->product->model ;

            }
        }        

        return $options;
    }

    public static function findtotal_available($product_id){

        $total = 0;

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total += $product->available;
            }
        }

        return $total;
    }

    public static function total_available($product_id,$branch_id){

        $total = 0;

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total += $product->available;
            }
        }

        return $total;
    }

    public static function total_inhandQty($product_id,$branch_id){

        $total = 0;

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total += $product->inhandQty;
            }
        }

        return $total;
    }

    public static function total_saleQty($product_id,$branch_id){

        $total = 0;

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total += $product->saleQty;
            }
        }

        return $total;
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

