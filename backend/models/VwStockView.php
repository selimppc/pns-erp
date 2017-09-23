<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwStockView extends \yii\db\ActiveRecord
{

    public $total;
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_stock_view}}';
    }

     public function rules()
    {
        return [
          
            [['total'],'safe']
        ];


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('app', 'Product Name'),
            'date'  => Yii::t('app', 'Expiry Date'),
            'cost_price' => Yii::t('app', 'Stock Rate')
        ];
    }
}

