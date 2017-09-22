<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use dosamigos\taggable\Taggable;

/**
 * This is the model class for table "{{%codes_param}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $code
 * @property string $title
 * @property integer $am_coa_id
 * @property integer $am_coa_cr_id
 * @property integer $am_coa_dr_id
 * @property string $long
 * @property string $percentage
 * @property integer $am_coa_tax_id
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa $amCoa
 * @property AmCoa $amCoaCr
 * @property AmCoa $amCoaDr
 * @property AmCoa $amCoaTax
 */
class CodesParam extends \yii\db\ActiveRecord
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
        return '{{%codes_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','code','title','status'],'required'],
            [['title'],'unique'],
            [['am_coa_id', 'am_coa_cr_id', 'am_coa_dr_id', 'am_coa_tax_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','am_coa_discount_id'], 'safe'],
            [['type', 'code', 'long'], 'string'],
            [['title'], 'string', 'max' => 45],
            [['percentage', 'status'], 'string', 'max' => 8],
            [['am_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_coa_id' => 'id']],
            [['am_coa_cr_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_coa_cr_id' => 'id']],
            [['am_coa_dr_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_coa_dr_id' => 'id']],
            [['am_coa_tax_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['am_coa_tax_id' => 'id']],
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
            'code' => Yii::t('app', 'Code'),
            'title' => Yii::t('app', 'Title'),
            'am_coa_id' => Yii::t('app', 'Am Coa'),
            'am_coa_cr_id' => Yii::t('app', 'Am Coa Cr'),
            'am_coa_dr_id' => Yii::t('app', 'Am Coa Dr'),
            'long' => Yii::t('app', 'Description'),
            'percentage' => Yii::t('app', 'Percentage'),
            'am_coa_tax_id' => Yii::t('app', 'Am Coa Tax'),
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
    public function getAmCoa()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmCoaCr()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_cr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmCoaDr()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_dr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmCoaTax()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'am_coa_tax_id']);
    }

    /**
     * @inheritdoc
     * @return CodesParamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CodesParamQuery(get_called_class());
    }
}
