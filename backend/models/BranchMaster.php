<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class BranchMaster extends \yii\db\ActiveRecord
{

	public $branch;
	public $from_date;
	public $to_date;
    public $year;
    public $month;
    public $report_type;
    public $product;

	public function rules()
    {
        return [           
            [['branch','from_date','to_date','year','month','report_type','product'], 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'branch'  => 'Branch',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'year' => 'Year',
            'month' => 'Month',
            'report_type' => 'Report Type',
            'product' => 'Product'
        ];
    }

}