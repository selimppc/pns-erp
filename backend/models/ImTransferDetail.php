<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%im_transfer_detail}}".
 *
 * @property integer $id
 * @property integer $im_transfer_head_id
 * @property integer $product_id
 * @property string $uom
 * @property string $quantity
 * @property string $rate
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImTransferHead $imTransferHead
 * @property Product $product
 */
class ImTransferDetail extends \yii\db\ActiveRecord
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
        return '{{%im_transfer_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id','uom','quantity','rate'],'required'],
            [['im_transfer_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['quantity', 'rate'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['uom'], 'string', 'max' => 8],
            [['im_transfer_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImTransferHead::className(), 'targetAttribute' => ['im_transfer_head_id' => 'id']],
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
            'im_transfer_head_id' => Yii::t('app', 'Transfer Head'),
            'product_id' => Yii::t('app', 'Product'),
            'uom' => Yii::t('app', 'Uom'),
            'quantity' => Yii::t('app', 'Quantity'),
            'rate' => Yii::t('app', 'Rate'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImTransferHead()
    {
        return $this->hasOne(ImTransferHead::className(), ['id' => 'im_transfer_head_id']);
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
    public function getUomData()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'uom']);
    }

    /**
     * @inheritdoc
     * @return ImTransferDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImTransferDetailQuery(get_called_class());
    }
}
