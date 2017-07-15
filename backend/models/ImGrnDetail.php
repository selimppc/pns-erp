<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%im_grn_detail}}".
 *
 * @property integer $id
 * @property integer $im_grn_head_id
 * @property integer $product_id
 * @property string $batch_number
 * @property string $expire_date
 * @property string $receive_quantity
 * @property string $cost_price
 * @property string $uom
 * @property string $quantity
 * @property string $row_amount
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImGrnHead $imGrnHead
 * @property Product $product
 */
class ImGrnDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%im_grn_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['im_grn_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['expire_date', 'created_at', 'updated_at'], 'safe'],
            [['receive_quantity', 'cost_price', 'quantity', 'row_amount'], 'number'],
            [['batch_number'], 'string', 'max' => 16],
            [['uom'], 'string', 'max' => 8],
            [['im_grn_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImGrnHead::className(), 'targetAttribute' => ['im_grn_head_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'im_grn_head_id' => Yii::t('app', 'Im Grn Head ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'batch_number' => Yii::t('app', 'Batch Number'),
            'expire_date' => Yii::t('app', 'Expire Date'),
            'receive_quantity' => Yii::t('app', 'Receive Quantity'),
            'cost_price' => Yii::t('app', 'Cost Price'),
            'uom' => Yii::t('app', 'Uom'),
            'quantity' => Yii::t('app', 'Quantity'),
            'row_amount' => Yii::t('app', 'Row Amount'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImGrnHead()
    {
        return $this->hasOne(ImGrnHead::className(), ['id' => 'im_grn_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return ImGrnDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImGrnDetailQuery(get_called_class());
    }
}