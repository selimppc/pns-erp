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
 * @property string $manufacture_code
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
            [['product_code','title','class','group','currency_id','model','size','origin','sell_rate','cost_price','sell_uom','sell_uom_qty','stock_uom','stock_uom_qty','stock_type','supplier_id'],'required'],
            [['product_code'],'unique'],
            [['description'], 'string'],
            [['class', 'group', 'category', 'currency_id', 'supplier_id', 'created_by', 'updated_by'], 'integer'],
            [['exchange_rate', 'sell_rate', 'cost_price', 'sell_uom_qty', 'purchase_uom_qty', 'sell_tax', 'stock_uom_qty'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_code', 'manufacture_code'], 'string', 'max' => 16],
            [['title', 'model', 'size', 'origin'], 'string', 'max' => 45],
            [['image', 'thumb_image'], 'string', 'max' => 64],
            [['sell_uom', 'purchase_uom', 'stock_uom', 'pack_size', 'stock_type', 'generic', 'max_level', 'min_level', 're_order'], 'string', 'max' => 8],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'thumb_image' => Yii::t('app', 'Thumb Image'),
            'class' => Yii::t('app', 'Class'),
            'group' => Yii::t('app', 'Group'),
            'category' => Yii::t('app', 'Category'),
            'currency_id' => Yii::t('app', 'Currency'),
            'model' => Yii::t('app', 'Model'),
            'size' => Yii::t('app', 'Size'),
            'origin' => Yii::t('app', 'Origin'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'sell_rate' => Yii::t('app', 'Sell Rate'),
            'cost_price' => Yii::t('app', 'Cost Price'),
            'sell_uom' => Yii::t('app', 'Sell Uom'),
            'sell_uom_qty' => Yii::t('app', 'Sell Uom Qty'),
            'purchase_uom' => Yii::t('app', 'Purchase Uom'),
            'purchase_uom_qty' => Yii::t('app', 'Purchase Uom Qty'),
            'sell_tax' => Yii::t('app', 'Sell Tax'),
            'stock_uom' => Yii::t('app', 'Stock Uom'),
            'stock_uom_qty' => Yii::t('app', 'Stock Uom Qty'),
            'pack_size' => Yii::t('app', 'Pack Size'),
            'stock_type' => Yii::t('app', 'Stock Type'),
            'generic' => Yii::t('app', 'Generic'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'manufacture_code' => Yii::t('app', 'Manufacture Code'),
            'max_level' => Yii::t('app', 'Max Level'),
            'min_level' => Yii::t('app', 'Min Level'),
            're_order' => Yii::t('app', 'Re Order'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
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
