<?php
namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class Transaction extends \yii\db\ActiveRecord{

	public $transaction_code;
	public $branch;
	public $from_date;
	public $to_date;
	public $transaction_status;

	public function rules()
    {
        return [           
            [['transaction_code','branch','from_date','to_date','transaction_status'], 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'transaction_code'  => 'Transaction',
            'branch' => 'Branch',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'transaction_status' => 'Transaction Status'
        ];
    }

}