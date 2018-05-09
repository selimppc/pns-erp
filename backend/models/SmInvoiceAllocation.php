<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class SmInvoiceAllocation extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date('Y-m-d H:i:s'),
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
        return '{{%sm_invoice_allocation}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sm_head_id' => Yii::t('app', 'Sm Head id'),
            'sm_number' => Yii::t('app','Sm Number'),
            'invoice_number' => Yii::t('app', 'Invoice Number'),
            'amount' => Yii::t('app', 'Amount'),
            'balance_amount' => Yii::t('app', 'Balance Amount')
        ];
    }

    public static function customer_info($sm_head_id = '')
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT customer.*,codes_param.title as customer_group, branch.title as branch_name
            FROM customer INNER JOIN sm_head ON sm_head.customer_id = customer.id
            INNER JOIN codes_param on codes_param.id = customer.customer_group
            INNER JOIN branch on branch.id = customer.branch_id
            WHERE sm_head.id ='$sm_head_id' ");

        $result = $command->queryOne();    

        return !empty($result)?$result:'';
    }

    
}

