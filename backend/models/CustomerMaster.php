<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class CustomerMaster extends \yii\db\ActiveRecord
{

	public $customer;
	public $from_date;
	public $to_date;

	public function rules()
    {
        return [           
            [['customer','from_date','to_date'], 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'customer'  => 'Customer',
            'from_date' => 'From Date',
            'to_date' => 'To Date'
        ];
    }

}