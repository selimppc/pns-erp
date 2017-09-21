<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%sm_detail}}".
 *
 * @property integer $id
 * @property integer $sm_head_id
 * @property integer $product_id
 * @property string $uom
 * @property string $uom_quantity
 * @property string $rate
 * @property string $bonus_quantity
 * @property string $quantity
 * @property string $row_amount
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SmHead $smHead
 * @property Product $product
 */
class SmDetail extends \yii\db\ActiveRecord
{
   
   public $total;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sm_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id','quantity','rate','uom'],'required'],
            [[ 'product_id', 'created_by', 'updated_by'], 'integer'],
            [['uom_quantity', 'rate', 'bonus_quantity', 'quantity', 'row_amount'], 'number'],
            [['created_at', 'updated_at','total'], 'safe'],
            [['sm_head_id'], 'exist', 'skipOnError' => true, 'targetClass' => SmHead::className(), 'targetAttribute' => ['sm_head_id' => 'id']],
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
            'sm_head_id' => Yii::t('app', 'Sm Head ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'uom' => Yii::t('app', 'Uom'),
            'uom_quantity' => Yii::t('app', 'Uom Quantity'),
            'rate' => Yii::t('app', 'Rate'),
            'bonus_quantity' => Yii::t('app', 'Bonus Quantity'),
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
    public function getSmHead()
    {
        return $this->hasOne(SmHead::className(), ['id' => 'sm_head_id']);
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
     * @return SmDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmDetailQuery(get_called_class());
    }
}
