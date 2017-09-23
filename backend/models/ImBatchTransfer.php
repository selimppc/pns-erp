<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

class ImBatchTransfer extends \yii\db\ActiveRecord{


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
        return '{{%im_batch_transfer}}';
    }


    public function rules()
    {
        return [
            [['im_transfer_head_id','product_id','batch_number','expire_date','quantity','uom','rate'],'required']            
        ];
    }


}