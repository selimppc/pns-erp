<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwSmMrReceive extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_sm_mr_receive}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoice_number' => Yii::t('app', 'Invoice Number'),
            'note' => Yii::t('app', 'Note'),
            'date' => Yii::t('app', 'Date'),
            'customer_id' => Yii::t('app', 'Customer Id'),
            'branch_id' => Yii::t('app', 'Branch Id'),
            'currency_id' => Yii::t('app','Currency Id'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'amount' => Yii::t('app', 'Amount')
        ];
    }

    public static function total_due_list()
    {
        $response = [];

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT *
            FROM vw_sm_mr_receive INNER JOIN sm_head ON vw_sm_mr_receive.invoice_number = sm_head.sm_number
            INNER JOIN sm_detail ON sm_detail.sm_head_id = sm_head.id
            ORDER BY vw_sm_mr_receive.customer_id ASC");

        $result = $command->queryAll();

        $customer_list_array = [];

        if(!empty($result))
        {
            foreach($result as $key => $value)
            {
                array_push($customer_list_array,$value['customer_id']);
            }
        }

        if(!empty($customer_list_array))
        {
            $customer_list = array_values(array_unique($customer_list_array));
            foreach($customer_list as $key => $values)
            {
                $customer_data = Yii::$app->db->createCommand("SELECT * FROM {{customer}} WHERE id ='$values'")->queryOne();

                $response[$key]['serial'] = $key+1;
                $response[$key]['customer_id'] = $values;
                $response[$key]['customer_name'] = isset($customer_data)?$customer_data['name']:'';

                $response[$key]['order_list'] = self::order_list($result,$values);
            }
        }


          return $response;  
    }


    public static function order_list($data='', $customer_id ='')
    {
        $response = [];

        if(!empty($data))
        {
            foreach ($data as $key => $value)
            {
                if ($value['customer_id'] == $customer_id )
                {
                    $sales_person_id = $value['sales_person_id'];
                    $sales_person_data = Yii::$app->db->createCommand("SELECT * FROM {{sales_person}} WHERE id ='$sales_person_id'")->queryOne();

                    $product_id = $value['product_id'];
                    $product_data = Yii::$app->db->createCommand("SELECT * FROM {{product}} WHERE id ='$product_id'")->queryOne();

                    $response[$key]['serial'] = $key + 1;
                    $response[$key]['sales_person_id'] = $value['sales_person_id'];
                    $response[$key]['sales_person_name'] = isset($sales_person_data)?$sales_person_data['name']:'';
                    $response[$key]['invoice_number'] = $value['invoice_number'];
                    $response[$key]['date'] = $value['date'];
                    $response[$key]['product_id'] = $value['product_id'];
                    $response[$key]['product_model'] = isset($product_data)?$product_data['model']:'';
                    $response[$key]['quantity'] = $value['quantity'];
                    $response[$key]['rate'] = $value['rate'];
                    $response[$key]['row_amount'] = $value['row_amount'];
                }
            }
        }

        return $response;
    }

    public static function total_receivable_amount($customer_id='')
    {
        $total_receivable_amount = Yii::$app->db->createCommand("SELECT SUM([[amount]]) FROM {{vw_sm_mr_receive}} WHERE customer_id = '$customer_id'")
            ->queryScalar();

        return $total_receivable_amount; 
    }

    public static function total_due()
    {
        $total_sales_return = Yii::$app->db->createCommand("SELECT SUM([[net_amount]]) FROM {{sm_head}} WHERE status ='returned' && doc_type = 'return'")
            ->queryScalar();


        $total_due = Yii::$app->db->createCommand("SELECT SUM([[amount]]) FROM {{vw_sm_mr_receive}}")
            ->queryScalar();

        return $total_due - $total_sales_return;    
    }

    
}

