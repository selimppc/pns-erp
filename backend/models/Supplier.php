<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%supplier}}".
 *
 * @property integer $id
 * @property string $supplier_code
 * @property string $org_name
 * @property string $address
 * @property string $state
 * @property string $zip
 * @property string $contct_person
 * @property string $phone
 * @property string $fax
 * @property string $cell
 * @property string $email
 * @property string $web_url
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ImGrnHead[] $imGrnHeads
 * @property PpPurchaseHead[] $ppPurchaseHeads
 * @property Product[] $products
 */
class Supplier extends \yii\db\ActiveRecord
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
        return '{{%supplier}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_code','org_name','address','status'],'required'],
            [['supplier_code'],'unique'],
            [['web_url'],'url'],
            [['address'], 'string'],
            [['zip'], 'number'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['supplier_code', 'state', 'phone', 'fax', 'cell', 'status'], 'string', 'max' => 16],
            [['org_name', 'contct_person', 'email', 'web_url'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'supplier_code' => Yii::t('app', 'Supplier Code'),
            'org_name' => Yii::t('app', 'Organization Name'),
            'address' => Yii::t('app', 'Organization Address'),
            'state' => Yii::t('app', 'Organization State'),
            'zip' => Yii::t('app', 'Organization Zip'),
            'contct_person' => Yii::t('app', 'Contct Person'),
            'phone' => Yii::t('app', 'Contct Person Phone'),
            'fax' => Yii::t('app', 'Contct Person Fax'),
            'cell' => Yii::t('app', 'Contct Person Cell'),
            'email' => Yii::t('app', 'Contct Person Email'),
            'web_url' => Yii::t('app', 'Organization Web Url'),
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
    public function getImGrnHeads()
    {
        return $this->hasMany(ImGrnHead::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpPurchaseHeads()
    {
        return $this->hasMany(PpPurchaseHead::className(), ['supplier_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['supplier_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery(get_called_class());
    }
}
