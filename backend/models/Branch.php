<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%branch}}".
 *
 * @property integer $id
 * @property string $branch_code
 * @property string $title
 * @property integer $currency_id
 * @property string $exchange_rate
 * @property string $contact_person
 * @property string $designation
 * @property string $mailing_addess
 * @property string $phone
 * @property string $fax
 * @property string $cell
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa[] $amCoas
 * @property AmVoucherDetail[] $amVoucherDetails
 * @property AmVoucherHead[] $amVoucherHeads
 * @property Currency $currency
 * @property Customer[] $customers
 * @property ImAdjustHead[] $imAdjustHeads
 * @property ImGrnHead[] $imGrnHeads
 * @property ImTransaction[] $imTransactions
 * @property ImTransferHead[] $imTransferHeads
 * @property ImTransferHead[] $imTransferHeads0
 * @property ItImGl[] $itImGls
 * @property PpPurchaseHead[] $ppPurchaseHeads
 * @property SmHead[] $smHeads
 * @property TransactionCode[] $transactionCodes
 */
class Branch extends \yii\db\ActiveRecord
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
        return '{{%branch}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_code','title','currency_id','exchange_rate','contact_person','designation','mailing_addess','phone','status'],'required'],
            [['title'],'unique'],
            [['currency_id', 'created_by', 'updated_by'], 'integer'],
            [['exchange_rate'], 'number'],
            [['mailing_addess'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['branch_code', 'phone', 'fax', 'cell'], 'string', 'max' => 16],
            [['title', 'contact_person', 'designation'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 8],
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
            'branch_code' => Yii::t('app', 'Branch Code'),
            'title' => Yii::t('app', 'Title'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
            'contact_person' => Yii::t('app', 'Contact Person'),
            'designation' => Yii::t('app', 'Designation'),
            'mailing_addess' => Yii::t('app', 'Mailing Addess'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'cell' => Yii::t('app', 'Cell'),
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
    public function getAmCoas()
    {
        return $this->hasMany(AmCoa::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmVoucherDetails()
    {
        return $this->hasMany(AmVoucherDetail::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmVoucherHeads()
    {
        return $this->hasMany(AmVoucherHead::className(), ['branch_id' => 'id']);
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
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImAdjustHeads()
    {
        return $this->hasMany(ImAdjustHead::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImGrnHeads()
    {
        return $this->hasMany(ImGrnHead::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransactions()
    {
        return $this->hasMany(ImTransaction::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransferHeads()
    {
        return $this->hasMany(ImTransferHead::className(), ['from_branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransferHeads0()
    {
        return $this->hasMany(ImTransferHead::className(), ['to_branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItImGls()
    {
        return $this->hasMany(ItImGl::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpPurchaseHeads()
    {
        return $this->hasMany(PpPurchaseHead::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmHeads()
    {
        return $this->hasMany(SmHead::className(), ['branch_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionCodes()
    {
        return $this->hasMany(TransactionCode::className(), ['branch_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BranchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BranchQuery(get_called_class());
    }
}
