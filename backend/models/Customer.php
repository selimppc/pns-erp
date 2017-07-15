<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property integer $id
 * @property string $customer_code
 * @property string $name
 * @property string $api_id
 * @property string $address
 * @property string $terotorry
 * @property integer $group_one_id
 * @property string $type
 * @property string $cell
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property integer $branch_id
 * @property string $market
 * @property string $sales_person
 * @property string $credit_limit
 * @property string $hub
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property GroupOne $groupOne
 * @property Branch $branch
 * @property SmHead[] $smHeads
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'string'],
            [['group_one_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['credit_limit'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['customer_code', 'api_id', 'terotorry', 'type', 'cell', 'phone', 'fax', 'hub', 'status'], 'string', 'max' => 16],
            [['name', 'market', 'sales_person'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 64],
            [['group_one_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupOne::className(), 'targetAttribute' => ['group_one_id' => 'id']],
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
            'customer_code' => Yii::t('app', 'Customer Code'),
            'name' => Yii::t('app', 'Name'),
            'api_id' => Yii::t('app', 'Api ID'),
            'address' => Yii::t('app', 'Address'),
            'terotorry' => Yii::t('app', 'Terotorry'),
            'group_one_id' => Yii::t('app', 'Group One ID'),
            'type' => Yii::t('app', 'Type'),
            'cell' => Yii::t('app', 'Cell'),
            'phone' => Yii::t('app', 'Phone'),
            'fax' => Yii::t('app', 'Fax'),
            'email' => Yii::t('app', 'Email'),
            'branch_id' => Yii::t('app', 'Branch ID'),
            'market' => Yii::t('app', 'Market'),
            'sales_person' => Yii::t('app', 'Sales Person'),
            'credit_limit' => Yii::t('app', 'Credit Limit'),
            'hub' => Yii::t('app', 'Hub'),
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
    public function getGroupOne()
    {
        return $this->hasOne(GroupOne::className(), ['id' => 'group_one_id']);
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
    public function getSmHeads()
    {
        return $this->hasMany(SmHead::className(), ['customer_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}