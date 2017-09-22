<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "am_voucher_detail".
 *
 * @property integer $id
 * @property integer $am_voucher_head_id
 * @property integer $am_coa_id
 * @property integer $am_sub_coa_id
 * @property integer $currency_id
 * @property string $exchange_rate
 * @property string $prime_amount
 * @property string $base_amount
 * @property integer $branch_id
 * @property string $note
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmVoucherHead $amVoucherHead
 * @property AmCoa $amCoa
 * @property AmCoa $amSubCoa
 * @property Currency $currency
 * @property Branch $branch
 */
class AmVoucherDetail extends \yii\db\ActiveRecord
{
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
        return 'am_voucher_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['am_voucher_head_id','am_coa_id','currency_id','branch_id','exchange_rate','prime_amount','base_amount','status'],'required'],
            [['am_voucher_head_id', 'am_coa_id', 'am_sub_coa_id', 'currency_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['exchange_rate', 'prime_amount', 'base_amount'], 'number'],
            [['note'], 'string'],
            [['created_at', 'updated_at','voucher_number'], 'safe'],
            [['status'], 'string', 'max' => 16],
            [['am_voucher_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmVoucherHead::className(), 'targetAttribute' => ['am_voucher_head_id' => 'id']],
            [['am_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_coa_id' => 'id']],
            [['am_sub_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_sub_coa_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'am_voucher_head_id' => 'Voucher Head',
            'am_coa_id' => 'Coa',
            'am_sub_coa_id' => 'Sub Coa',
            'currency_id' => 'Currency',
            'exchange_rate' => 'Exchange Rate',
            'prime_amount' => 'Prime Amount',
            'base_amount' => 'Base Amount',
            'branch_id' => 'Branch',
            'note' => 'Note',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmVoucherHead()
    {
        return $this->hasOne(AmVoucherHead::className(), ['id' => 'am_voucher_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmCoa()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmSubCoa()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_sub_coa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
}
