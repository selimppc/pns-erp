<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%users_activity}}".
 *
 * @property integer $id
 * @property string $table_name
 * @property string $table_id
 * @property string $action_note
 * @property string $url
 * @property string $reference
 * @property string $comment
 * @property integer $users_id
 * @property string $date
 */
class UsersActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users_activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_note', 'reference', 'comment'], 'string'],
            [['users_id'], 'integer'],
            [['date'], 'safe'],
            [['table_name', 'table_id'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'table_name' => Yii::t('app', 'Table Name'),
            'table_id' => Yii::t('app', 'Table ID'),
            'action_note' => Yii::t('app', 'Action Note'),
            'url' => Yii::t('app', 'Url'),
            'reference' => Yii::t('app', 'Reference'),
            'comment' => Yii::t('app', 'Comment'),
            'users_id' => Yii::t('app', 'Users ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

    /**
     * @inheritdoc
     * @return UsersActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersActivityQuery(get_called_class());
    }
}
