<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class ProductMaster extends \yii\db\ActiveRecord
{

	public $product_class;
	public $product_group;

    public function rules()
    {
        return [           
            [['product_class','product_group'], 'required'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_class'  => 'Product Class',
            'product_group' => 'Product Group'
        ];
    }

}