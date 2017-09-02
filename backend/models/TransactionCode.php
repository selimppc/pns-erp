<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use dosamigos\taggable\Taggable;

/**
 * This is the model class for table "{{%transaction_code}}".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $last_number
 * @property string $increment
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Branch $branch
 */
class TransactionCode extends \yii\db\ActiveRecord
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
        return '{{%transaction_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','code','title','last_number','increment'],'required'],
            [['code'],'unique'],
            [['branch_id', 'created_by', 'updated_by'], 'integer'],
            [['last_number', 'increment'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 4,'min' => 4],
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
            'type' => Yii::t('app', 'Type'),
            'code' => Yii::t('app', 'Transaction code'),
            'title' => Yii::t('app', 'Title'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'last_number' => Yii::t('app', 'Last Number'),
            'increment' => Yii::t('app', 'Increment'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    // Generate Transaction Number :: Parameter is code
    public function generate_transaction_number($type=''){

        $transaction_data = TransactionCode::find()->where(['code' => $type])->one();

        $number = str_pad($transaction_data->last_number+$transaction_data->increment,8,"0",STR_PAD_LEFT);

        $invoice_number = $type.$number;

        return $invoice_number;


    }


    // Update Transaction Number :: Parameter is code
    public function update_transaction_number($type=''){

        $po_transaction_data = TransactionCode::find()->where(['code' => $type])->one();

        $po_transaction_data->last_number = $po_transaction_data->last_number + $po_transaction_data->increment;


       $valid = $po_transaction_data->validate();

       if(!$valid){
        print_r($po_transaction_data->getErrors());
        exit();
       }

        if($po_transaction_data->save()){
            return true;
        }else{
            return false;
        }

    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @inheritdoc
     * @return TransactionCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionCodeQuery(get_called_class());
    }
}
