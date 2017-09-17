<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%im_grn_head}}".
 *
 * @property integer $id
 * @property string $grn_number
 * @property integer $pp_purchase_head_id
 * @property integer $am_voucher_head_id
 * @property integer $supplier_id
 * @property string $date
 * @property string $pay_terms
 * @property integer $branch_id
 * @property string $tax_rate
 * @property string $tax_ammount
 * @property string $discount_rate
 * @property string $discount_amount
 * @property integer $currency_id
 * @property string $exchange_rate
 * @property string $prime_amount
 * @property string $net_amount
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImGrnDetail[] $imGrnDetails
 * @property PpPurchaseHead $ppPurchaseHead
 * @property AmVoucherHead $amVoucherHead
 * @property Supplier $supplier
 * @property Branch $branch
 * @property Currency $currency
 */
class ImGrnHead extends \yii\db\ActiveRecord
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
        return '{{%im_grn_head}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grn_number','pp_purchase_head_id','supplier_id','date','pay_terms','branch_id'],'required'],
            [['pp_purchase_head_id', 'am_voucher_head_id', 'supplier_id', 'branch_id', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['tax_rate', 'tax_amount', 'discount_rate', 'discount_amount', 'exchange_rate', 'prime_amount', 'net_amount'], 'number'],
            [['grn_number', 'pay_terms', 'status'], 'string', 'max' => 16],
            [['pp_purchase_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => PpPurchaseHead::className(), 'targetAttribute' => ['pp_purchase_head_id' => 'id']],
            [['am_voucher_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmVoucherHead::className(), 'targetAttribute' => ['am_voucher_head_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'grn_number' => Yii::t('app', 'GRN Number'),
            'pp_purchase_head_id' => Yii::t('app', 'Purchase Order Number '),
            'am_voucher_head_id' => Yii::t('app', 'Voucher'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'date' => Yii::t('app', 'Date'),
            'pay_terms' => Yii::t('app', 'Pay Terms'),
            'branch_id' => Yii::t('app', 'Branch'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'tax_amount' => Yii::t('app', 'Tax Amount'),
            'discount_rate' => Yii::t('app', 'Discount Rate'),
            'discount_amount' => Yii::t('app', 'Discount Amount'),
            'currency_id' => Yii::t('app', 'Currency'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'prime_amount' => Yii::t('app', 'Prime Amount'),
            'net_amount' => Yii::t('app', 'Net Amount'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }



    public static function update_grn_amount($grn_id){

        $model = ImGrnDetail::find()->where(['im_grn_head_id' => $grn_id])->all();

        if(!empty($model)){

            $prime_amount = 0.00;
            $net_amount = 0.00;
            foreach($model as $value){
                $prime_amount+=$value->cost_price*$value->receive_quantity;
                $net_amount+=$value->cost_price*$value->receive_quantity;
            }

            $grn_head = ImGrnHead::find()->where(['id' => $grn_id])->one();

            $grn_head->prime_amount = $prime_amount;
            $grn_head->net_amount = $net_amount;

            if($grn_head->save()){
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
    public function getImGrnDetails()
    {
        return $this->hasMany(ImGrnDetail::className(), ['im_grn_head_id' => 'id']);
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
    public function getAmVoucherHead()
    {
        return $this->hasOne(AmVoucherHead::className(), ['id' => 'am_voucher_head_id']);
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
     * @return ImGrnHeadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImGrnHeadQuery(get_called_class());
    }
}
