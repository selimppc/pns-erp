<?php

namespace backend\models;

use Yii;

use backend\models\CodesParam;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%im_transaction}}".
 *
 * @property integer $id
 * @property string $transaction_number
 * @property integer $product_id
 * @property integer $branch_id
 * @property string $batch_number
 * @property string $date
 * @property string $expire_date
 * @property string $uom
 * @property string $quantity
 * @property string $sign
 * @property string $foreign_rate
 * @property string $rate
 * @property string $total_price
 * @property string $base_value
 * @property string $reference_number
 * @property string $reference_row
 * @property string $note
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product $product
 * @property Branch $branch
 */
class ImTransaction extends \yii\db\ActiveRecord
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
        return '{{%im_transaction}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_number','product_id','branch_id','batch_number','uom','quantity','base_value','foreign_rate','total_price'],'required'],
            [['product_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['date', 'expire_date', 'created_at', 'updated_at', 'supplier_id'], 'safe'],
            [['quantity', 'foreign_rate', 'rate', 'total_price', 'base_value'], 'number'],
            [['sign', 'note'], 'string'],
            [['transaction_number', 'reference_number', 'reference_row', 'status'], 'string', 'max' => 16],
            [['batch_number'], 'string', 'max' => 45],
            [['uom'], 'string', 'max' => 8],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaction_number' => Yii::t('app', 'Transaction Number'),
            'product_id' => Yii::t('app', 'Product'),
            'supplier_id' => Yii:t('app', 'Supplier'),
            'branch_id' => Yii::t('app', 'Branch'),
            'batch_number' => Yii::t('app', 'Batch Number'),
            'date' => Yii::t('app', 'Date'),
            'expire_date' => Yii::t('app', 'Expire Date'),
            'uom' => Yii::t('app', 'Uom'),
            'quantity' => Yii::t('app', 'Quantity'),
            'sign' => Yii::t('app', 'Sign'),
            'foreign_rate' => Yii::t('app', 'Foreign Rate'),
            'rate' => Yii::t('app', 'Rate'),
            'total_price' => Yii::t('app', 'Total Price'),
            'base_value' => Yii::t('app', 'Base Value'),
            'reference_number' => Yii::t('app', 'Reference Number'),
            'reference_row' => Yii::t('app', 'Reference Row'),
            'note' => Yii::t('app', 'Note'),
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
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
    public function getTransactionUom()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'uom']);
    }

    /**
     * @inheritdoc
     * @return ImTransactionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImTransactionQuery(get_called_class());
    }
}
