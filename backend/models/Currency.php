<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%currency}}".
 *
 * @property integer $id
 * @property string $currency_code
 * @property string $title
 * @property string $exchange_rate
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmVoucherDetail[] $amVoucherDetails
 * @property Branch[] $branches
 * @property ImAdjustHead[] $imAdjustHeads
 * @property ImGrnHead[] $imGrnHeads
 * @property ImTransferHead[] $imTransferHeads
 * @property ImTransferHead[] $imTransferHeads0
 * @property Product[] $products
 * @property SmHead[] $smHeads
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currency}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_code','title','status'],'required'],
            [['currency_code'],'unique'],
            [['exchange_rate'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['currency_code'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 45],
            [['status'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'currency_code' => Yii::t('app', 'Currency Code'),
            'title' => Yii::t('app', 'Title'),
            'exchange_rate' => Yii::t('app', 'Exchange Rate'),
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
    public function getAmVoucherDetails()
    {
        return $this->hasMany(AmVoucherDetail::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branch::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImAdjustHeads()
    {
        return $this->hasMany(ImAdjustHead::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImGrnHeads()
    {
        return $this->hasMany(ImGrnHead::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransferHeads()
    {
        return $this->hasMany(ImTransferHead::className(), ['from_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransferHeads0()
    {
        return $this->hasMany(ImTransferHead::className(), ['to_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmHeads()
    {
        return $this->hasMany(SmHead::className(), ['currency_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CurrencyQuery(get_called_class());
    }
}
