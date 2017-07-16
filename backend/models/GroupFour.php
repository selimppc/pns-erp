<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%group_four}}".
 *
 * @property integer $id
 * @property integer $group_three_id
 * @property string $title
 * @property string $description
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa[] $amCoas
 * @property GroupThree $groupThree
 */
class GroupFour extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_four}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_three_id','title'],'required'],
            [['title'],'unique'],
            [['group_three_id', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['group_three_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupThree::className(), 'targetAttribute' => ['group_three_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_three_id' => Yii::t('app', 'Group Three'),
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
        return $this->hasMany(AmCoa::className(), ['group_four_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupThree()
    {
        return $this->hasOne(GroupThree::className(), ['id' => 'group_three_id']);
    }

    /**
     * @inheritdoc
     * @return GroupFourQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupFourQuery(get_called_class());
    }
}
