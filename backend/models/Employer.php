<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "employer".
 *
 * @property integer $id
 * @property string $employer_code
 * @property string $name
 * @property string $api_id
 * @property string $address
 * @property string $terotorry
 * @property string $type
 * @property string $cell
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property integer $branch_id
 * @property string $market
 * @property string $credit_limit
 * @property string $hub
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Employer extends \yii\db\ActiveRecord
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
        return 'employer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employer_code'],'unique'],
            [['email'],'email'],
            [['name','employer_code','branch_id','status'],'required'],
            [['address'], 'string'],
            [['branch_id', 'created_by', 'updated_by'], 'integer'],
            [['credit_limit'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['employer_code', 'api_id', 'terotorry', 'type', 'cell', 'phone', 'fax', 'hub', 'status'], 'string', 'max' => 16],
            [['name', 'market'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employer_code' => 'Employee Code',
            'name' => 'Name',
            'api_id' => 'Api ID',
            'address' => 'Address',
            'terotorry' => 'Terotorry',
            'type' => 'Type',
            'cell' => 'Cell',
            'phone' => 'Phone',
            'fax' => 'Fax',
            'email' => 'Email',
            'branch_id' => 'Branch ID',
            'market' => 'Market',
            'credit_limit' => 'Credit Limit',
            'hub' => 'Hub',
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
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

     public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
}
