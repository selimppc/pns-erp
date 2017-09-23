<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;


class VwApPayable extends \yii\db\ActiveRecord
{

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%vw_ap_payable}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => Yii::t('app', 'Supplier Code'),
            'org_name' => Yii::t('app', 'Organization Name'),
            'branch_id'  => Yii::t('app', 'Branch'),
            'am_coa_id' => Yii::t('app', 'Chart of Account'),
            'coa_title' => Yii::t('app', 'Chart of Account Title'),
            'contct_person' => Yii::t('app','Contact Person'),
            'payable_amount'> Yii::t('app', 'Payable Amount')
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmCoa()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_id']);
    }
}