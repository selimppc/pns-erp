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
            'product_style' => Yii::t('app', 'Style'),
            'product_model' => Yii::t('app', 'Item / Model'),
            'product_title'  => Yii::t('app', 'Product Title'),
            'product_description'  => Yii::t('app', 'Description'),
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


    public static function get_stock_data($branch='')
    {
        if(!empty($branch))
        {
            $data = VwImStockView::find()->where(['branch_id'=>$branch])->groupBy(['product_id'])->orderBy([
            'product_sort_order' => SORT_ASC])->all();

        }else{

            $data = VwImStockView::find()->groupBy(['product_id'])->orderBy([
            'product_sort_order' => SORT_ASC])->all();

        }

        

        $response = [];

        if(!empty($data))
        {
            foreach($data as $key=>$value)
            {
                $response[$key]['serial'] = $key+1;
                $response[$key]['product_id'] = $value->product_id;
                $response[$key]['product_code'] = $value->product_code;
                $response[$key]['product_style'] = $value->product_style;
                $response[$key]['product_model'] = $value->product_model;
                $response[$key]['product_description'] = $value->product_description;
                $response[$key]['product_title'] = $value->product_title;
                $response[$key]['sell_rate'] = $value->sell_rate; 

                $branch_data = self::branch_data($value->product_id,$branch);

                $response[$key]['branch'] = $branch_data;

                $response[$key]['product_uom'] = isset($value->productUom)?$value->productUom->title:'';

                $response[$key]['total_qty'] = self::findtotal_available($value->product_id,$branch);
            }
        }

        return $response;
    }


    public static function branch_data($product_id,$branch='')
    {

        $response = [];

        if(!empty($branch))
        {
            $data = VwImStockView::find()->where(['product_id'=> $product_id])->andWhere(['branch_id'=> $branch])->groupBy(['branch_id'])->all();    
        }else{
            $data = VwImStockView::find()->where(['product_id'=> $product_id])->groupBy(['branch_id'])->all();
        }
        


        if(!empty($data))
        {
            foreach($data as $key=>$value)
            {
                $response[$key]['branch_id'] = $value->branch_id;
                $response[$key]['branch_name'] = $value->branch['title'];
                $response[$key]['total_purchase_qty'] = self::total_inhandQty($product_id,$value->branch_id);
                $response[$key]['sales_qty'] = self::total_saleQty($product_id,$value->branch_id);
                $response[$key]['available_qty'] = self::total_available($product_id,$value->branch_id);
            }
        }

        return $response;
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

    public static function findtotal_available($product_id, $branch = ''){

        $total = 0;

        $total_inhand_qty = 0;
        $total_available_qty = 0;

        if(!empty($branch))
        {
            $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch])->all();
        }else{
            $product_q = VwImStockView::find()->where(['product_id' => $product_id])->all();    
        }

        if(!empty($product_q)){
            foreach($product_q as $product){
                
                $total_available_qty += $product->available;    
                
            }
        }

        return $total_available_qty;
        

        if(!empty($product_q)){
            foreach($product_q as $product){
                if($product->inhandQty > 0)
                {
                    $total_inhand_qty += $product->inhandQty;    
                }
                
            }
        }

        $total_sale_qty = 0;

        #$product_q = VwImStockView::find()->where(['product_id' => $product_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total_sale_qty += $product->saleQty;
            }
        }

        $total = $total_inhand_qty - $total_sale_qty;

        return $total;
    }

    public static function total_available($product_id,$branch_id){

        $total = 0;

        /*$product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total += abs($product->available);
            }
        }*/

        $total_inhand_qty = 0;
        $total_available_qty = 0;

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();


        if(!empty($product_q)){
            foreach($product_q as $product){
                
                $total_available_qty += $product->available;    
                
            }
        }

        return $total_available_qty;

        if(!empty($product_q)){
            foreach($product_q as $product){
                if($product->inhandQty > 0)
                {
                    $total_inhand_qty += $product->inhandQty;    
                }
                
            }
        }


        $total_sale_qty = 0;

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                $total_sale_qty += $product->saleQty;
            }
        }

        $total = $total_inhand_qty - $total_sale_qty;

        return $total;
    }

    public static function total_inhandQty($product_id,$branch_id){

        $total = 0;

        $qty = Yii::$app->db->createCommand("SELECT SUM([[inhandQty]]) FROM {{vw_im_stock_view}} WHERE branch_id = '$branch_id' && product_id = '$product_id'")
            ->queryScalar();

         return $qty;   

        $product_q = VwImStockView::find()->where(['product_id' => $product_id])->andWhere(['branch_id' => $branch_id])->all();

        if(!empty($product_q)){
            foreach($product_q as $product){
                if($product->inhandQty > 0)
                {
                    $total += $product->inhandQty;    
                }
                
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

