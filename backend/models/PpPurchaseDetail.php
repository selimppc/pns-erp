<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%pp_purchase_detail}}".
 *
 * @property integer $id
 * @property integer $pp_purchase_head_id
 * @property integer $product_id
 * @property string $quantity
 * @property string $grn_quantity
 * @property string $tax_rate
 * @property string $tax_amount
 * @property string $uom
 * @property string $uom_quantity
 * @property string $unit_quantity
 * @property string $purchase_rate
 * @property string $row_amount
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PpPurchaseHead $ppPurchaseHead
 * @property Product $product
 */
class PpPurchaseDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pp_purchase_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pp_purchase_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['quantity', 'grn_quantity', 'tax_rate', 'tax_amount', 'uom_quantity', 'unit_quantity', 'purchase_rate', 'row_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['uom', 'status'], 'string', 'max' => 16],
            [['pp_purchase_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => PpPurchaseHead::className(), 'targetAttribute' => ['pp_purchase_head_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pp_purchase_head_id' => Yii::t('app', 'Pp Purchase Head ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'grn_quantity' => Yii::t('app', 'Grn Quantity'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'tax_amount' => Yii::t('app', 'Tax Amount'),
            'uom' => Yii::t('app', 'Uom'),
            'uom_quantity' => Yii::t('app', 'Uom Quantity'),
            'unit_quantity' => Yii::t('app', 'Unit Quantity'),
            'purchase_rate' => Yii::t('app', 'Purchase Rate'),
            'row_amount' => Yii::t('app', 'Row Amount'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpPurchaseHead()
    {
        return $this->hasOne(PpPurchaseHead::className(), ['id' => 'pp_purchase_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return PpPurchaseDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PpPurchaseDetailQuery(get_called_class());
    }
}