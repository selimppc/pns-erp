<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%im_adjust_head}}".
 *
 * @property integer $id
 * @property string $transaction_no
 * @property string $date
 * @property integer $branch_id
 * @property string $type
 * @property string $confirm_date
 * @property integer $currency_id
 * @property string $exchange_rate
 * @property string $voucher_number
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImAdjustDetail[] $imAdjustDetails
 * @property Branch $branch
 * @property Currency $currency
 */
class ImAdjustHead extends \yii\db\ActiveRecord
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
        return '{{%im_adjust_head}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_no','date','confirm_date','currency_id','branch_id','voucher_number'],'required'],
            [['date', 'confirm_date', 'created_at', 'updated_at'], 'safe'],
            [['branch_id', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['type'], 'string'],
            [['exchange_rate'], 'number'],
            [['transaction_no', 'voucher_number'], 'string', 'max' => 16],
            [['status'], 'string', 'max' => 8],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaction_no' => Yii::t('app', 'Transaction No'),
            'date' => Yii::t('app', 'Date'),
            'branch_id' => Yii::t('app', 'Branch'),
            'type' => Yii::t('app', 'Type'),
            'confirm_date' => Yii::t('app', 'Confirm Date'),
            'currency_id' => Yii::t('app', 'Currency'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'voucher_number' => Yii::t('app', 'Voucher Number'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImAdjustDetails()
    {
        return $this->hasMany(ImAdjustDetail::className(), ['im_adjust_head_id' => 'id']);
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
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }

    /**
     * @inheritdoc
     * @return ImAdjustHeadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImAdjustHeadQuery(get_called_class());
    }
}
