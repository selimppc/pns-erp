<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%am_coa}}".
 *
 * @property integer $id
 * @property string $account_code
 * @property string $title
 * @property string $description
 * @property string $account_type
 * @property string $account_usage
 * @property integer $group_one_id
 * @property integer $group_two_id
 * @property integer $group_three_id
 * @property integer $group_four_id
 * @property string $analyical_code
 * @property integer $branch_id
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property GroupOne $groupOne
 * @property GroupTwo $groupTwo
 * @property GroupThree $groupThree
 * @property GroupFour $groupFour
 * @property Branch $branch
 * @property AmVoucherDetail[] $amVoucherDetails
 * @property AmVoucherDetail[] $amVoucherDetails0
 * @property CodesParam[] $codesParams
 * @property CodesParam[] $codesParams0
 * @property CodesParam[] $codesParams1
 * @property CodesParam[] $codesParams2
 * @property ItImToAp[] $itImToAps
 * @property SmHead[] $smHeads
 */
class AmCoa extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' =>date('Y-m-d H:i:s'),
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
        return '{{%am_coa}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_code','title','account_type','branch_id','status'],'required'],
            [['account_code'],'unique'],
            [['description'], 'string'],
            [['group_one_id', 'group_two_id', 'group_three_id', 'group_four_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['account_code', 'account_type', 'account_usage', 'analyical_code', 'status'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 100],
            [['group_one_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupOne::className(), 'targetAttribute' => ['group_one_id' => 'id']],
            [['group_two_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupTwo::className(), 'targetAttribute' => ['group_two_id' => 'id']],
            [['group_three_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupThree::className(), 'targetAttribute' => ['group_three_id' => 'id']],
            [['group_four_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupFour::className(), 'targetAttribute' => ['group_four_id' => 'id']],
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
            'account_code' => Yii::t('app', 'Account Code'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'account_type' => Yii::t('app', 'Account Type'),
            'account_usage' => Yii::t('app', 'Account Usage'),
            'group_one_id' => Yii::t('app', 'Group One'),
            'group_two_id' => Yii::t('app', 'Group Two'),
            'group_three_id' => Yii::t('app', 'Group Three'),
            'group_four_id' => Yii::t('app', 'Group Four'),
            'analyical_code' => Yii::t('app', 'Analyical Code'),
            'branch_id' => Yii::t('app', 'Branch'),
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
    public function getGroupTwo()
    {
        return $this->hasOne(GroupTwo::className(), ['id' => 'group_two_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupThree()
    {
        return $this->hasOne(GroupThree::className(), ['id' => 'group_three_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupFour()
    {
        return $this->hasOne(GroupFour::className(), ['id' => 'group_four_id']);
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
    public function getAmVoucherDetails()
    {
        return $this->hasMany(AmVoucherDetail::className(), ['am_coa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmVoucherDetails0()
    {
        return $this->hasMany(AmVoucherDetail::className(), ['am_sub_coa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodesParams()
    {
        return $this->hasMany(CodesParam::className(), ['am_coa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodesParams0()
    {
        return $this->hasMany(CodesParam::className(), ['am_coa_cr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodesParams1()
    {
        return $this->hasMany(CodesParam::className(), ['am_coa_dr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodesParams2()
    {
        return $this->hasMany(CodesParam::className(), ['am_coa_tax_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItImToAps()
    {
        return $this->hasMany(ItImToAp::className(), ['dr_coa_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmHeads()
    {
        return $this->hasMany(SmHead::className(), ['am_coa_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AmCoaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AmCoaQuery(get_called_class());
    }
}
