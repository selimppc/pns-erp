<?php 
namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class PurchaseMaster extends \yii\db\ActiveRecord{

	public $purchase_order;

	public function rules()
    {
        return [           
            [['purchase_order'], 'safe'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'purchase_order'  => 'Purchase Order Number List'
        ];
    }
}