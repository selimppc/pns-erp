<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%sm_head}}".
 *
 * @property integer $id
 * @property string $sm_number
 * @property string $date
 * @property integer $customer_id
 * @property string $doc_type
 * @property integer $branch_id
 * @property integer $am_coa_id
 * @property string $check_number
 * @property integer $currency_id
 * @property string $exchange_rate
 * @property string $note
 * @property string $tax_rate
 * @property string $tax_amount
 * @property string $discount_rate
 * @property string $discount_amount
 * @property string $prime_amount
 * @property string $net_amount
 * @property string $sign
 * @property string $status
 * @property string $reference_code
 * @property string $gl_voucher_number
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SmDetail[] $smDetails
 * @property Customer $customer
 * @property Branch $branch
 * @property AmCoa $amCoa
 * @property Currency $currency
 */
class SmHead extends \yii\db\ActiveRecord
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
        return '{{%sm_head}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sm_number','date','customer_id','doc_type','currency_id','exchange_rate','branch_id','pay_terms','sales_person_id'],'required','on'=>'create'],
            [['sm_number','date','customer_id','doc_type','currency_id','exchange_rate','branch_id','prime_amount','net_amount', 'pay_terms'],'required','on'=>'create_direct_sales'],
            [['date', 'created_at', 'updated_at','commission'], 'safe'],
            [['customer_id', 'branch_id', 'am_coa_id', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['exchange_rate', 'tax_rate', 'tax_amount', 'discount_rate', 'discount_amount', 'prime_amount', 'net_amount'], 'number'],
            [['note'], 'string'],
            [['sm_number', 'doc_type', 'sign', 'status', 'reference_code', 'gl_voucher_number'], 'string', 'max' => 16],
            [['check_number'], 'string', 'max' => 45],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['am_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_coa_id' => 'id']],
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
            'sm_number' => Yii::t('app', 'Sales Number'),
            'date' => Yii::t('app', 'Sales Date'),
            'commission' => Yii::t('app','Commission'),
            'sales_person_id' => Yii::t('app','Sales Person'),
            'customer_id' => Yii::t('app', 'Customer Name'),
            'doc_type' => Yii::t('app', 'Doc Type'),
            'pay_terms' => Yii::t('app','Pay Terms'),
            'branch_id' => Yii::t('app', 'Branch'),
            'am_coa_id' => Yii::t('app', 'Am Coa ID'),
            'check_number' => Yii::t('app', 'Check Number'),
            'currency_id' => Yii::t('app', 'Currency'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'note' => Yii::t('app', 'Note'),
            'tax_rate' => Yii::t('app', 'Tax Rate'),
            'tax_amount' => Yii::t('app', 'Tax Amount'),
            'discount_rate' => Yii::t('app', 'Discount Rate (%)'),
            'discount_amount' => Yii::t('app', 'Discount Amount'),
            'prime_amount' => Yii::t('app', 'Total Amount'),
            'net_amount' => Yii::t('app', 'Net Amount'),
            'sign' => Yii::t('app', 'Sign'),
            'status' => Yii::t('app', 'Status'),
            'reference_code' => Yii::t('app', 'Reference Code'),
            'gl_voucher_number' => Yii::t('app', 'Gl Voucher Number'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function total_sales_value($date1='',$date2='')
    {

        if(!empty($date1) && !empty($date2))
        {

            $total_sales = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE date BETWEEN '$date1' AND '$date2'")
            ->queryScalar();

        }else{

            $total_sales = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE date = '$date1'")
            ->queryScalar();

        }

        return $total_sales;   
    }


    public static function update_sale_invoice_amount($invoiced_id){

        $model = SmDetail::find()->where(['sm_head_id' => $invoiced_id])->all();

        if(!empty($model)){

            $prime_amount = 0.00;
            $net_amount = 0.00;
            foreach($model as $value){
                $prime_amount+=$value->quantity*$value->rate;
                $net_amount+=$value->quantity*$value->rate;
            }

            $sm_head = SmHead::find()->where(['id' => $invoiced_id])->one();

            if($sm_head->discount_rate > 0){
                $discount_price = ($prime_amount * $sm_head->discount_rate) / 100;
            }else{
                $discount_price = $sm_head->discount_amount;
            }

            $sm_head->prime_amount = $prime_amount;
            $sm_head->net_amount = ($net_amount - $discount_price) + $sm_head->tax_amount;
            
            if($sm_head->save()){
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
    public function getSmDetails()
    {
        return $this->hasMany(SmDetail::className(), ['sm_head_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesperson()
    {
        return $this->hasOne(SalesPerson::className(), ['id' => 'sales_person_id']);
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
    public function getAmCoa()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_id']);
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
     * @return SmHeadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmHeadQuery(get_called_class());
    }
}
