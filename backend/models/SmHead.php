<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use backend\models\Product;
use backend\models\Branch;
use backend\models\Customer;
use backend\models\SalesPerson;

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

    public $money_receipt_amount;
    public $money_receipt_discount_amount;
    public $money_receipt_customer_name;
    public $money_receipt_branch;

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
            [['sm_number'],'required','on'=>'sales_return'],
            [['sm_number','date','customer_id','doc_type','currency_id','exchange_rate','branch_id','prime_amount','net_amount', 'pay_terms'],'required','on'=>'create_direct_sales'],

            [['sm_number','date','customer_id','status','branch_id','currency_id','exchange_rate','money_receipt_amount','am_coa_id'],'required','on'=>'create_money_receipt'],

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
            'money_receipt_amount' => Yii::t('app','Amount'),
            'money_receipt_discount_amount' => Yii::t('app','Discount Amount'),
            'sm_number' => Yii::t('app', 'Sales Number'),
            'date' => Yii::t('app', 'Sales Date'),
            'commission' => Yii::t('app','Commission'),
            'sales_person_id' => Yii::t('app','Sales Person'),
            'customer_id' => Yii::t('app', 'Customer Name'),
            'doc_type' => Yii::t('app', 'Doc Type'),
            'pay_terms' => Yii::t('app','Pay Terms'),
            'branch_id' => Yii::t('app', 'Branch'),
            'am_coa_id' => Yii::t('app', 'Bank/Cash'),
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


    public static function daily_report($date1='',$date2='')
    {
        $response = [];

        if(!empty($date1) && !empty($date2))
        {

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT *
                FROM sm_detail INNER JOIN sm_head ON sm_head.id = sm_detail.sm_head_id
                WHERE status ='confirmed' && date BETWEEN '$date1' AND '$date2'
                #GROUP BY product_id
                ORDER BY sm_number ASC");

            $result = $command->queryAll();

        }else{

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT *
                FROM sm_detail INNER JOIN sm_head ON sm_head.id = sm_detail.sm_head_id
                WHERE status ='confirmed' && date = '$date1'
                #GROUP BY product_id
                ORDER BY sm_number ASC");

            $result = $command->queryAll();

        }

        $sales_person_array = array();

        if(!empty($result))
        {
            // push sales person id 
            foreach($result as $key => $values)
            {
                array_push($sales_person_array,$values['sales_person_id']);
            }
        }

        

        if(count($sales_person_array) > 0)
        {
            foreach(array_unique($sales_person_array) as $key => $values)
            {

                $sales_person_data = Yii::$app->db->createCommand("SELECT * FROM {{sales_person}} WHERE id ='$values'")->queryOne();

                $response[$key]['serial'] = $key+1;
                $response[$key]['sales_person_id'] = $values;
                $response[$key]['sales_person_name'] = !empty($sales_person_data)?$sales_person_data['name']:'';
               # $response[$key]['customer_list'] = self::customer_list($result,$values);
                $response[$key]['order_list'] = self::order_list($result,$values);
            }
        }



         return $response;
    }


    public static function collection_report($date1 = '', $date2 = '')
    {

        $response = [];

        if(!empty($date1) && !empty($date2))
        {

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT sales_person_id,customer_id, sm_invoice_allocation.sm_number, sm_invoice_allocation.created_at, am_coa_id, check_number, sm_invoice_allocation.invoice_number, sm_invoice_allocation.note, sm_invoice_allocation.amount
                FROM sm_invoice_allocation 
                JOIN sm_head ON sm_head.sm_number = sm_invoice_allocation.invoice_number
                WHERE sm_invoice_allocation.created_at BETWEEN '$date1' AND '$date2'");

            $result = $command->queryAll();

        }else{

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT sales_person_id,customer_id, sm_invoice_allocation.sm_number, sm_invoice_allocation.created_at, am_coa_id, check_number, sm_invoice_allocation.invoice_number, sm_invoice_allocation.note, sm_invoice_allocation.amount
                FROM sm_invoice_allocation 
                JOIN sm_head ON sm_head.sm_number = sm_invoice_allocation.invoice_number
                WHERE DATE(sm_invoice_allocation.created_at) = '$date1'");

            $result = $command->queryAll();

        }

        $sales_person_id = [];
        if(!empty($result))
        {
            foreach($result as $key => $values)
            {
                array_push($sales_person_id, $values['sales_person_id']);
            }
        }


        if(count($sales_person_id) > 0)
        {
            foreach(array_values(array_unique($sales_person_id)) as $key => $values)
            {

                $sales_person_data = Yii::$app->db->createCommand("SELECT * FROM {{sales_person}} WHERE id ='$values'")->queryOne();

                $response[$key]['serial'] = $key+1;
                $response[$key]['sales_person_id'] = $values;
                $response[$key]['sales_person_name'] = isset($sales_person_data)?$sales_person_data['name']:'';

                $response[$key]['collection_list'] = self::money_receipt($result,$values);
            }
        }

        return $response;


    }


    public static function money_receipt($data = '', $sales_person_id = '' )
    {
        $response = [];
        $result = [];

        if(!empty($data))
        {
            foreach($data as $key => $value)
            {
                if($value['sales_person_id'] == $sales_person_id)
                {
                    $am_coa_id = $value['am_coa_id'];
                    $am_coa_data = Yii::$app->db->createCommand("SELECT * FROM {{am_coa}} WHERE id ='$am_coa_id'")->queryOne();

                    $customer_id = $value['customer_id'];
                    $customer_data = Yii::$app->db->createCommand("SELECT * FROM {{customer}} WHERE id ='$customer_id'")->queryOne();

                    $timestamp = strtotime($value['created_at']);

                    $date = date('Y-m-d', $timestamp);

                    $response[$key]['customer_id'] = $value['customer_id'];
                    $response[$key]['customer_name'] = isset($customer_data)?$customer_data['name']:'';
                    $response[$key]['money_receipt'] = $value['sm_number'];
                    $response[$key]['date'] = $date;
                    $response[$key]['bank_or_cash_id'] = $value['am_coa_id'];
                    $response[$key]['bank_or_cash'] = !empty($am_coa_data)?$am_coa_data['title']:'';
                    $response[$key]['check_number'] = $value['check_number'];
                    $response[$key]['invoice_number'] = $value['invoice_number'];
                    $response[$key]['note'] = $value['note'];
                    $response[$key]['amount'] = $value['amount'];
                }
            }
        }

        return $response;
    }


    public static function customer_list($data = '', $sales_person_id)
    {
        $response = [];

        $customer_list_array = array();
        
        if(!empty($data))
        {
            foreach($data as $key => $values)
            {
                if (strpos($values['sales_person_id'], $sales_person_id ) !== false)
                {
                    array_push($customer_list_array,$values['customer_id']);
                }
            }


            if(count($customer_list_array) > 0)
            {
                foreach(array_unique($customer_list_array) as $key => $values)
                {
                    $customer_data = Yii::$app->db->createCommand("SELECT * FROM {{customer}} WHERE id ='$values'")->queryOne();

                    $response[$key]['serial'] = $key + 1;
                    $response[$key]['customer_id'] = $values;
                    $response[$key]['customer_name'] = !empty($customer_data)?$customer_data['name']:'';
                }
            }
        }

        return $response;
    }

    public static function order_list($data = '',$sales_person_id = '')
    {
        $response = [];

        if(!empty($data))
        {
            foreach ($data as $key => $value) {
                
                #if (strpos($value['sales_person_id'], $sales_person_id ) !== false)
                if($value['sales_person_id'] == $sales_person_id)
                {

                    $customer_id = $value['customer_id'];
                    $customer_data = Yii::$app->db->createCommand("SELECT * FROM {{customer}} WHERE id ='$customer_id'")->queryOne();

                    $product_id = $value['product_id'];
                    $product_data = Yii::$app->db->createCommand("SELECT * FROM {{product}} WHERE id ='$product_id'")->queryOne();

                    $response[$key]['serial'] = $key + 1;
                    $response[$key]['customer_id'] = $customer_id;
                    $response[$key]['customer_name'] = !empty($customer_data)?$customer_data['name']:'';
                    $response[$key]['sm_number'] = $value['sm_number'];
                    $response[$key]['note'] = $value['note'];
                    $response[$key]['date'] = $value['date'];
                    $response[$key]['product_id'] = $value['product_id'];
                    $response[$key]['product_model'] = !empty($product_data)?$product_data['model']:'';
                    $response[$key]['quantity'] = $value['quantity'];
                    $response[$key]['sell_rate'] = $value['sell_rate'];
                    $response[$key]['sub_total'] = $value['quantity'] * $value['sell_rate'];
                    $response[$key]['total_discount'] = $value['total_discount'];
                    $response[$key]['total_amount'] = $value['quantity'] * $value['rate'];
                }

                
            }
        }

        return $response;
    }

    public static function total_sales($product_id='', $date1='',$date2='')
    {

        $response = [];

        if(!empty($date1) && !empty($date2))
        {

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT SUM(sm_detail.quantity) as total_qty,SUM(sm_head.prime_amount) as total_amount,SUM(sm_head.discount_amount) as discount_amount,SUM(sm_head.net_amount) as net_amount,branch_id,customer_id,sales_person_id
                FROM sm_detail INNER JOIN sm_head ON sm_head.id = sm_detail.sm_head_id
                WHERE status ='confirmed' && product_id ='$product_id' && date BETWEEN '$date1' AND '$date2'
                GROUP BY branch_id
                ORDER BY branch_id ASC");

            
            $result = $command->queryAll();
        
        }else{

            $connection = Yii::$app->getDb();
            $command = $connection->createCommand("
                SELECT SUM(sm_detail.quantity) as total_qty,SUM(sm_head.prime_amount) as total_amount,SUM(sm_head.discount_amount) as discount_amount,SUM(sm_head.net_amount) as net_amount,branch_id,customer_id,sales_person_id
                FROM sm_detail INNER JOIN sm_head ON sm_head.id = sm_detail.sm_head_id
                WHERE status ='confirmed' && product_id ='$product_id' && date = '$date1'
                GROUP BY branch_id
                ORDER BY branch_id ASC");

            
            $result = $command->queryAll();

        }
        

        if(!empty($result))
        {
            foreach($result as $key => $values)
            {

                $branch_data = Branch::find()->where(['id'=> $values['branch_id']])->one();

                $response[$key]['branch_id'] = $values['branch_id'];
                $response[$key]['branch_name'] = !empty($branch_data)?$branch_data->title:'';
                $response[$key]['total_qty'] = $values['total_qty'];
                $response[$key]['total_amount'] = $values['total_amount'];
                $response[$key]['discount_amount'] = $values['discount_amount'];
                $response[$key]['net_amount'] = $values['net_amount'];
            }
        }


        return $response;
    }

    public static function total_delievered_qty($date1='',$date2='',$status='')
    {
        if(!empty($date1) && !empty($date2))
        {
            $total_delievered_qty = Yii::$app->db->createCommand("SELECT COUNT([[sm_detail.id]]) FROM {{sm_head}} JOIN {{sm_detail}} ON sm_head.id = sm_detail.sm_head_id  WHERE status ='$status' && date BETWEEN '$date1' AND '$date2'")
            ->queryScalar();

        }elseif (!empty($date1)) {
            
            $total_delievered_qty = Yii::$app->db->createCommand("SELECT COUNT([[sm_detail.id]]) FROM {{sm_head}} JOIN {{sm_detail}} ON sm_head.id = sm_detail.sm_head_id  WHERE status ='$status' && date = '$date1'")
            ->queryScalar();

        }else{
            
            $total_delievered_qty = Yii::$app->db->createCommand("SELECT COUNT([[sm_detail.id]]) FROM {{sm_head}} JOIN {{sm_detail}} ON sm_head.id = sm_detail.sm_head_id  WHERE status ='$status'")
            ->queryScalar();

        }



        return $total_delievered_qty;
    }


    public static function total_collection($date1='', $date2='')
    {
       if(!empty($date1) && !empty($date2))
        {

            $total_collection = Yii::$app->db->createCommand("SELECT SUM([[amount]]) FROM {{sm_invoice_allocation}} WHERE created_at BETWEEN '$date1' AND '$date2'")
            ->queryScalar();

        }elseif(!empty($date1))
        {

            $total_collection = Yii::$app->db->createCommand("SELECT SUM([[amount]]) FROM {{sm_invoice_allocation}} WHERE DATE(sm_invoice_allocation.created_at) = '$date1'")
            ->queryScalar();

        }else{

            $total_collection = Yii::$app->db->createCommand("SELECT SUM([[amount]]) FROM {{sm_invoice_allocation}}")
            ->queryScalar();

        }

        return $total_collection;  
    }

    public static function total_sales_value($date1='', $date2='')
    {

        if(!empty($date1) && !empty($date2))
        {

            $total_sales = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE status ='confirmed' && doc_type = 'sales' && date BETWEEN '$date1' AND '$date2'")
            ->queryScalar();

        }elseif(!empty($date1))
        {

            $total_sales = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE status ='confirmed' && doc_type = 'sales' && date = '$date1'")
            ->queryScalar();

        }else{

            $total_sales_return = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE status ='returned' && doc_type = 'return'")
            ->queryScalar();

            $total_sales_value = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE status ='confirmed' && doc_type = 'sales'")
            ->queryScalar();

            $total_sales = $total_sales_value - $total_sales_return;

        }

        return $total_sales;   
    }


    public static function update_sale_invoice_amount($invoiced_id){

        $model = SmDetail::find()->where(['sm_head_id' => $invoiced_id])->all();

        if(!empty($model)){

            $prime_amount = 0.00;
            $net_amount = 0.00;
            foreach($model as $value){
                $prime_amount+=$value->quantity*$value->sell_rate;
                $net_amount+=$value->quantity*$value->sell_rate;
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
