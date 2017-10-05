<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class SmBatchSale extends \yii\db\ActiveRecord{

	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
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
        return '{{%sm_batch_sale}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sm_head_id','product_id','batch_number','expire_date','uom','quantity','bonus_quantity','sell_rate','rate','tax_rate','tax_amount','line_amount','courency_id','exchange_rate','reference_code'],'safe']
        ];
    }

}