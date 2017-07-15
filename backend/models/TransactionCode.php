<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%transaction_code}}".
 *
 * @property integer $id
 * @property string $trn_code
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
            [['branch_id', 'created_by', 'updated_by'], 'integer'],
            [['last_number', 'increment'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['trn_code', 'status'], 'string', 'max' => 8],
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
            'trn_code' => Yii::t('app', 'Trn Code'),
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
