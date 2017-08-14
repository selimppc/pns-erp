<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "am_voucher_head".
 *
 * @property integer $id
 * @property string $voucher_number
 * @property string $date
 * @property string $reference
 * @property integer $year
 * @property integer $period
 * @property integer $branch_id
 * @property string $note
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmVoucherDetail[] $amVoucherDetails
 * @property Branch $branch
 * @property ImGrnHead[] $imGrnHeads
 */
class AmVoucherHead extends \yii\db\ActiveRecord
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
        return 'am_voucher_head';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['voucher_number','status','branch_id','date','year'],'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['date','year', 'period', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['note'], 'string'],
            [['voucher_number', 'status'], 'string', 'max' => 16],
            [['reference'], 'string', 'max' => 128],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'voucher_number' => 'Voucher Number',
            'date' => 'Date',
            'reference' => 'Reference',
            'year' => 'Year',
            'period' => 'Period',
            'branch_id' => 'Branch',
            'note' => 'Note',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmVoucherDetails()
    {
        return $this->hasMany(AmVoucherDetail::className(), ['am_voucher_head_id' => 'id']);
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
    public function getImGrnHeads()
    {
        return $this->hasMany(ImGrnHead::className(), ['am_voucher_head_id' => 'id']);
    }
}
