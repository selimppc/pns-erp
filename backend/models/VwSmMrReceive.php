<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwSmMrReceive extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_sm_mr_receive}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoice_number' => Yii::t('app', 'Invoice Number'),
            'customer_id' => Yii::t('app', 'Customer Id'),
            'branch_id' => Yii::t('app', 'Branch Id'),
            'currency_id' => Yii::t('app','Currency Id'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'amount' => Yii::t('app', 'Amount')
        ];
    }



    
}

