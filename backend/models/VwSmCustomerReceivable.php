<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class VwSmCustomerReceivable extends \yii\db\ActiveRecord
{
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_sm_customer_receivable}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sm_head_id' => Yii::t('app', 'Sm Head id'),
            'customer_id' => Yii::t('app', 'Customer Id'),
            'customer_code' => Yii::t('app', 'Customer Code'),
            'customer_name' => Yii::t('app', 'Customer Name'),
            'customer_group' => Yii::t('app', 'Customer Group'),
            'branch_id' => Yii::t('app', 'Branch Id'),
            'customer_address' => Yii::t('app', 'Customer Address'),
            'customer_cell' => Yii::t('app', 'Customer Cell'),
            'customer_phone' => Yii::t('app', 'Customer Phone')
        ];
    }


     /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer_group_data()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'customer_group']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    
}

