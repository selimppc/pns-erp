<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%pp_purchase_head}}".
 *
 * @property integer $id
 * @property string $po_order_number
 * @property string $date
 * @property integer $supplier_id
 * @property string $pay_terms
 * @property string $delivery_date
 * @property integer $branch_id
 * @property string $tax_rate
 * @property string $tax_amount
 * @property string $discount_rate
 * @property string $discount_amount
 * @property string $prime_amount
 * @property string $net_amount
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImGrnHead[] $imGrnHeads
 * @property PpPurchaseDetail[] $ppPurchaseDetails
 * @property Supplier $supplier
 * @property Branch $branch
 */
class PpPurchaseHead extends \yii\db\ActiveRecord
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
        return '{{%pp_purchase_head}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           # [['supplier_id','branch_id','tax_rate','po_order_number'],'required'],
            [['po_order_number','date','delivery_date','supplier_id','pay_terms','branch_id','tax_rate','tax_amount','discount_rate','discount_amount','prime_amount','net_amount'],'required'],
            [['date', 'delivery_date', 'created_at', 'updated_at'], 'safe'],
            [['supplier_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['tax_rate', 'tax_amount', 'discount_rate', 'discount_amount', 'prime_amount', 'net_amount'], 'number'],
            [['po_order_number', 'pay_terms', 'status'], 'string', 'max' => 16],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'po_order_number' => Yii::t('app', 'PO No'),
            'date' => Yii::t('app', 'Date'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'pay_terms' => Yii::t('app', 'Pay Terms'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'branch_id' => Yii::t('app', 'Branch'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'tax_amount' => Yii::t('app', 'Tax Amount'),
            'discount_rate' => Yii::t('app', 'Discount Rate'),
            'discount_amount' => Yii::t('app', 'Discount Amount'),
            'prime_amount' => Yii::t('app', 'Prime Amount'),
            'net_amount' => Yii::t('app', 'Net Amount'),
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
    public function getImGrnHeads()
    {
        return $this->hasMany(ImGrnHead::className(), ['pp_purchase_head_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpPurchaseDetails()
    {
        return $this->hasMany(PpPurchaseDetail::className(), ['pp_purchase_head_id' => 'id']);
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
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @inheritdoc
     * @return PpPurchaseHeadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PpPurchaseHeadQuery(get_called_class());
    }
}
