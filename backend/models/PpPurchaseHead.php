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
            [['po_order_number','date','delivery_date','supplier_id','pay_terms','branch_id','currency_id','exchange_rate'],'required'],
            [['date', 'delivery_date', 'created_at', 'updated_at', 'note'], 'safe'],
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
            'currency_id' => Yii::t('app', 'Currency'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'po_order_number' => Yii::t('app', 'PO No'),
            'date' => Yii::t('app', 'Date'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'pay_terms' => Yii::t('app', 'Payment Terms'),
            'delivery_date' => Yii::t('app', 'Delivery Date'),
            'branch_id' => Yii::t('app', 'Branch'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'tax_amount' => Yii::t('app', 'Tax Amount'),
            'discount_rate' => Yii::t('app', 'Discount Rate (%)'),
            'discount_amount' => Yii::t('app', 'Discount Amount'),
            'prime_amount' => Yii::t('app', 'Prime Amount'),
            'net_amount' => Yii::t('app', 'Total Amount'),
            'status' => Yii::t('app', 'Status'),
            'note' => Yii::t('app', 'Note'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function stock_list_data($po_status = '')
    {
        $data = Yii::$app->db->createCommand("SELECT style,model,title, quantity, sell_rate, cost_price FROM {{pp_purchase_detail}} JOIN {{pp_purchase_head}} ON pp_purchase_detail.pp_purchase_head_id = pp_purchase_head.id JOIN {{product}} ON product.id = pp_purchase_detail.product_id WHERE pp_purchase_head.status ='$po_status'")->queryAll();


        return $data;
        
    }

    public static function total_po_qty($po_status='')
    {
        /*$po_qty = Yii::$app->db->createCommand("SELECT count([[id]]) FROM {{pp_purchase_head}} WHERE status = '$po_status'")
            ->queryScalar();*/

        $po_qty = Yii::$app->db->createCommand("SELECT SUM([[pp_purchase_detail.quantity]]) FROM {{pp_purchase_detail}} JOIN {{pp_purchase_head}} ON pp_purchase_detail.pp_purchase_head_id = pp_purchase_head.id  WHERE pp_purchase_head.status ='$po_status'")->queryScalar();

        return empty($po_qty)?'0':$po_qty;    
    }

    public static function update_purchase_order_amount($purchsed_order_id){

        $model = PpPurchaseDetail::find()->where(['pp_purchase_head_id' => $purchsed_order_id])->all();

        if(!empty($model)){

            $prime_amount = 0.00;
            $net_amount = 0.00;
            foreach($model as $value){
                $prime_amount+=$value->quantity*$value->purchase_rate;
                $net_amount+=$value->quantity*$value->purchase_rate;
            }

            $purchase_head = PpPurchaseHead::find()->where(['id' => $purchsed_order_id])->one();

            $purchase_head->prime_amount = $prime_amount;
            $purchase_head->net_amount = $net_amount;

            if($purchase_head->save()){
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }



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
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
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
