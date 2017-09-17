<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%im_transfer_head}}".
 *
 * @property integer $id
 * @property string $transfer_number
 * @property string $date
 * @property string $confirm_date
 * @property string $note
 * @property integer $from_branch_id
 * @property integer $from_currency_id
 * @property string $from_exchange_rate
 * @property integer $to_branch_id
 * @property integer $to_currency_id
 * @property string $to_exchange_rate
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImTransferDetail[] $imTransferDetails
 * @property Branch $fromBranch
 * @property Currency $fromCurrency
 * @property Branch $toBranch
 * @property Currency $toCurrency
 */
class ImTransferHead extends \yii\db\ActiveRecord
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
        return '{{%im_transfer_head}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transfer_number','confirm_date','from_branch_id','from_currency_id','to_branch_id','to_currency_id','from_exchange_rate','to_exchange_rate'],'required'],
            [['date', 'confirm_date', 'created_at', 'updated_at'], 'safe'],
            [['note'], 'string'],
            [['from_branch_id', 'from_currency_id', 'to_branch_id', 'to_currency_id', 'created_by', 'updated_by'], 'integer'],
            [['from_exchange_rate', 'to_exchange_rate'], 'number'],
            [['transfer_number', 'status'], 'string', 'max' => 16],
            [['from_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['from_branch_id' => 'id']],
            [['from_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['from_currency_id' => 'id']],
            [['to_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['to_branch_id' => 'id']],
            [['to_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['to_currency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transfer_number' => Yii::t('app', 'Transfer Number'),
            'date' => Yii::t('app', 'Transfer Issue Date'),
            'confirm_date' => Yii::t('app', 'Transfer Confirm Date'),
            'note' => Yii::t('app', 'Note'),
            'from_branch_id' => Yii::t('app', 'From Branch'),
            'from_currency_id' => Yii::t('app', 'From Currency'),
            'from_exchange_rate' => Yii::t('app', 'From Exch. Rate'),
            'to_branch_id' => Yii::t('app', 'To Branch'),
            'to_currency_id' => Yii::t('app', 'To Currency'),
            'to_exchange_rate' => Yii::t('app', 'To Exch. Rate'),
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
    public function getImTransferDetails()
    {
        return $this->hasMany(ImTransferDetail::className(), ['im_transfer_head_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'from_branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'from_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'to_branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'to_currency_id']);
    }

    /**
     * @inheritdoc
     * @return ImTransferHeadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImTransferHeadQuery(get_called_class());
    }
}
