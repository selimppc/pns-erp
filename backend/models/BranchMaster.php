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

	public function rules()
    {
        return [           
            [['branch','from_date','to_date'], 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'branch'  => 'Branch',
            'from_date' => 'From Date',
            'to_date' => 'To Date'
        ];
    }

}