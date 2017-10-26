<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

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
    public $grn_number;
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
        return '{{%im_grn_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['im_grn_head_id','product_id','batch_number','uom','receive_quantity','cost_price','row_amount','quantity'],'required'],
            #[['batch_number'],'unique'],
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
            'grn_number' => Yii::t('app','GRN Number'),
            'id' => Yii::t('app', 'ID'),
            'im_grn_head_id' => Yii::t('app', 'Im Grn Head'),
            'product_id' => Yii::t('app', 'Product'),
            'batch_number' => Yii::t('app', 'Batch Number'),
            'expire_date' => Yii::t('app', 'Expire Date'),
            'receive_quantity' => Yii::t('app', 'Receive Quantity'),
            'cost_price' => Yii::t('app', 'Cost Price'),
            'uom' => Yii::t('app', 'Uom'),
            'quantity' => Yii::t('app', 'UOM Quantity'),
            'row_amount' => Yii::t('app', 'Total Amount'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function grn_data($grn='',$product_id=''){

        $grn_head = ImGrnHead::find()->where(['grn_number' => $grn])->one();

        if(!empty($grn_head)){

            $grn_details = ImGrnDetail::find()->where(['im_grn_head_id'=>$grn_head->id])->andWhere(['product_id' => $product_id])->one();

            return $grn_details;

        }else{
            return '';
        }

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
    public function getProductUom()
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
     * @return ImGrnDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImGrnDetailQuery(get_called_class());
    }
}
