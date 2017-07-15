<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%group_one}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $create_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa[] $amCoas
 * @property Customer[] $customers
 * @property GroupTwo[] $groupTwos
 */
class GroupOne extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_one}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['create_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'create_by' => Yii::t('app', 'Create By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmCoas()
    {
        return $this->hasMany(AmCoa::className(), ['group_one_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['group_one_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupTwos()
    {
        return $this->hasMany(GroupTwo::className(), ['group_one_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GroupOneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupOneQuery(get_called_class());
    }
}
