<?php

namespace backend\models;

use Yii;
use backend\models\GroupOne;

/**
 * This is the model class for table "{{%group_two}}".
 *
 * @property integer $id
 * @property integer $group_one_id
 * @property string $title
 * @property string $description
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa[] $amCoas
 * @property GroupThree[] $groupThrees
 * @property GroupOne $groupOne
 */
class GroupTwo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_two}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_one_id','title'],'required'],
            [['title'],'unique'],
            [['group_one_id', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['group_one_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupOne::className(), 'targetAttribute' => ['group_one_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_one_id' => Yii::t('app', 'Group One'),
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
        return $this->hasMany(AmCoa::className(), ['group_two_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupThrees()
    {
        return $this->hasMany(GroupThree::className(), ['group_two_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupOne()
    {
        return $this->hasOne(GroupOne::className(), ['id' => 'group_one_id']);
    }

    /**
     * @inheritdoc
     * @return GroupTwoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupTwoQuery(get_called_class());
    }
}
