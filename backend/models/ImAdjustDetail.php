<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%im_adjust_detail}}".
 *
 * @property integer $id
 * @property integer $im_adjust_head_id
 * @property integer $product_id
 * @property string $batch_number
 * @property string $expire_date
 * @property string $uom
 * @property string $quantity
 * @property string $stock_rate
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImAdjustHead $imAdjustHead
 * @property Product $product
 */
class ImAdjustDetail extends \yii\db\ActiveRecord
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
        return '{{%im_adjust_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['product_id','batch_number','expire_date','uom','quantity','stock_rate'],'required'],
            [['product_id'],'required'],
            [['im_adjust_head_id', 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['expire_date', 'created_at', 'updated_at'], 'safe'],
            [['quantity', 'stock_rate'], 'number'],
            [['batch_number'], 'string', 'max' => 16],
            [['uom'], 'string', 'max' => 8],
            [['im_adjust_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImAdjustHead::className(), 'targetAttribute' => ['im_adjust_head_id' => 'id']],
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
            'im_adjust_head_id' => Yii::t('app', 'Stock Adjustment Head'),
            'product_id' => Yii::t('app', 'Product'),
            'batch_number' => Yii::t('app', 'Batch Number'),
            'expire_date' => Yii::t('app', 'Expire Date'),
            'uom' => Yii::t('app', 'Uom'),
            'quantity' => Yii::t('app', 'Quantity'),
            'stock_rate' => Yii::t('app', 'Stock Rate'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImAdjustHead()
    {
        return $this->hasOne(ImAdjustHead::className(), ['id' => 'im_adjust_head_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getUomData()
    {
        return $this->hasOne(CodesParam::className(), ['id' => 'uom']);
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
     * @return ImAdjustDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImAdjustDetailQuery(get_called_class());
    }
}
