<?php
namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class Chartofaccounts extends \yii\db\ActiveRecord{

	public $account_type;

	public function rules()
    {
        return [           
            [['account_type'], 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'account_type'  => 'Account Type'
        ];
    }

}