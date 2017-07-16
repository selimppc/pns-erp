<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%group_three}}".
 *
 * @property integer $id
 * @property integer $group_two_id
 * @property string $title
 * @property string $description
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa[] $amCoas
 * @property GroupFour[] $groupFours
 * @property GroupTwo $groupTwo
 */
class GroupThree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_three}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_two_id','title'],'required'],
            [['title'],'unique'],
            [['group_two_id', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['group_two_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupTwo::className(), 'targetAttribute' => ['group_two_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_two_id' => Yii::t('app', 'Group Two'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'created_by' => Yii::t('app', 'Created By'),
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
        return $this->hasMany(AmCoa::className(), ['group_three_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupFours()
    {
        return $this->hasMany(GroupFour::className(), ['group_three_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupTwo()
    {
        return $this->hasOne(GroupTwo::className(), ['id' => 'group_two_id']);
    }

    /**
     * @inheritdoc
     * @return GroupThreeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupThreeQuery(get_called_class());
    }
}
