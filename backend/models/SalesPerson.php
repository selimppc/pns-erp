<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "sales_person".
 *
 * @property integer $id
 * @property string $sales_person_code
 * @property string $name
 * @property string $api_id
 * @property string $address
 * @property string $terotorry
 * @property string $type
 * @property string $cell
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $branch_id
 * @property string $market
 * @property string $credit_limit
 * @property string $hub
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class SalesPerson extends \yii\db\ActiveRecord
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
        return 'sales_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_person_code'],'unique'],
            [['name','sales_person_code','branch_id','status','commission'],'required'],
            [['email'],'email'],
            [['address'], 'string'],
            [['branch_id', 'created_by', 'updated_by'], 'integer'],
            [['credit_limit'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['sales_person_code', 'api_id', 'terotorry', 'type', 'cell', 'phone', 'fax', 'hub', 'status', 'commission'], 'string', 'max' => 16],
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
            'sales_person_code' => 'Sales Person Code',
            'name' => 'Sales Person Name',
            'api_id' => 'Api ID',
            'address' => 'Sales Person Address',
            'terotorry' => 'Sales Person Terotorry',
            'type' => 'Type',
            'cell' => 'Sales Person Cell',
            'phone' => 'Sales Person Phone',
            'fax' => 'Sales Person Fax',
            'email' => 'Sales Person Email',
            'branch_id' => 'Branch',
            'market' => 'Market',
            'credit_limit' => 'Credit Limit',
            'hub' => 'Hub',
            'status' => 'Status',
            'commission' => 'Commission (%)',
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
