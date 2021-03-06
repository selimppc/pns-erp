<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $thumb_image
 * @property integer $class
 * @property integer $group
 * @property integer $category
 * @property integer $currency_id
 * @property string $model
 * @property string $size
 * @property string $origin
 * @property string $exchange_rate
 * @property string $sell_rate
 * @property string $cost_price
 * @property string $sell_uom
 * @property string $sell_uom_qty
 * @property string $purchase_uom
 * @property string $purchase_uom_qty
 * @property string $sell_tax
 * @property string $stock_uom
 * @property string $stock_uom_qty
 * @property string $pack_size
 * @property string $stock_type
 * @property string $generic
 * @property integer $supplier_id
 * @property string $manufacturer_code
 * @property string $max_level
 * @property string $min_level
 * @property string $re_order
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImAdjustDetail[] $imAdjustDetails
 * @property ImGrnDetail[] $imGrnDetails
 * @property ImTransaction[] $imTransactions
 * @property ImTransferDetail[] $imTransferDetails
 * @property PpPurchaseDetail[] $ppPurchaseDetails
 * @property Currency $currency
 * @property Supplier $supplier
 * @property SmDetail[] $smDetails
 */
class Product extends \yii\db\ActiveRecord
{

   

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
                ],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code','title','class','group','currency_id','model','origin','stock_type', 'sell_rate', 'cost_price','status'],'required'],
            #[['product_code'],'unique'],
            [['description'], 'string'],
            [['image'], 'file'],
            [['class', 'group', 'category', 'currency_id', 'supplier_id', 'created_by', 'updated_by'], 'integer'],
            [['exchange_rate', 'sell_rate', 'cost_price', 'sell_uom_qty', 'purchase_uom_qty', 'sell_tax', 'stock_uom_qty'], 'number'],
            [['created_at', 'updated_at','image','style','sort_order'], 'safe'],
            [['product_code', 'manufacturer_code','manufacturer_year','machine_size','speed'], 'string', 'max' => 16],
            [['model', 'size', 'origin'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 128],
            
            [['sell_uom', 'purchase_uom', 'stock_uom', 'pack_size','generic', 'max_level', 'min_level', 're_order'], 'string', 'max' => 8],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_code' => Yii::t('app', 'Product Code'),
            'style' => Yii::t('app','Style'),
            'title' => Yii::t('app', 'Product Title'),
            'description' => Yii::t('app', 'Product Description'),
            'image' => Yii::t('app', 'Image'),
            'thumb_image' => Yii::t('app', 'Thumb Image'),
            'class' => Yii::t('app', 'Product Class'),
            'group' => Yii::t('app', 'Product Group'),
            'category' => Yii::t('app', 'Product Category'),
            'currency_id' => Yii::t('app', 'Product Currency'),
            'model' => Yii::t('app', 'Product Model'),
            'size' => Yii::t('app', 'Product Size'),
            'origin' => Yii::t('app', 'Product Origin'),
            'exchange_rate' => Yii::t('app', 'Product Exchange Rate'),
            'sell_rate' => Yii::t('app', 'Product Sell Rate'),
            'cost_price' => Yii::t('app', 'Product Cost Price'),
            'sell_uom' => Yii::t('app', 'Product Sell UOM'),
            'sell_uom_qty' => Yii::t('app', 'Product Sell Unit Of Measurement Qty'),
            'purchase_uom' => Yii::t('app', 'Product Purchase UOM'),
            'purchase_uom_qty' => Yii::t('app', 'Product Purchase UOM Qty'),
            'sell_tax' => Yii::t('app', 'Product Sell Tax'),
            'stock_uom' => Yii::t('app', 'Product Stock UOM'),
            'stock_uom_qty' => Yii::t('app', 'Product Stock UOM Qty'),
            'pack_size' => Yii::t('app', 'Product Pack Size'),
            'stock_type' => Yii::t('app', 'Product Stock Type'),
            'generic' => Yii::t('app', 'Product Generic'),
            'supplier_id' => Yii::t('app', 'Product Supplier'),
            'manufacturer_code' => Yii::t('app', 'Product Manufacture Code'),
            'manufacturer_year' => Yii::t('app','Product Manufacturer Year'),
            'speed' => Yii::t('app','Product Speed'),
            'machine_size' => Yii::t('app','Product Machine Size'),
            'max_level' => Yii::t('app', 'Product Max Level'),
            'min_level' => Yii::t('app', 'Product Min Level'),
            're_order' => Yii::t('app', 'Product Re Order'),
            'status' => Yii::t('app', 'Status'),
            'sort_order' => Yii::t('app','Sort Order'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */

    public static function get_product_list() {
        $options = [];
        $product_q = Product::find()->where(['status'=>'active'])->all();
        
        if(!empty($product_q)){
            foreach ($product_q as $key => $value) {
                $options[$value->id] = $value->title . ' :: '.$value->product_code . ' :: '.$value->model;

            }
        }        

        return $options;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImAdjustDetails()
    {
        return $this->hasMany(ImAdjustDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImGrnDetails()
    {
        return $this->hasMany(ImGrnDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransactions()
    {
        return $this->hasMany(ImTransaction::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransferDetails()
    {
        return $this->hasMany(ImTransferDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpPurchaseDetails()
    {
        return $this->hasMany(PpPurchaseDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

     public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct_class()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'class']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct_group()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'group']);
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct_category()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'category']);
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct_sell_uom()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'sell_uom']);
    }

       /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct_purchase_uom()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'purchase_uom']);
    }

       /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct_stock_uom()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'stock_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmDetails()
    {
        return $this->hasMany(SmDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
