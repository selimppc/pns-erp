<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%it_im_to_ap}}".
 *
 * @property integer $id
 * @property string $item_group
 * @property string $sub_group
 * @property integer $dr_coa_id
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AmCoa $drCoa
 */
class ItImToAp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%it_im_to_ap}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dr_coa_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['item_group', 'sub_group', 'status'], 'string', 'max' => 16],
            [['dr_coa_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmCoa::className(), 'targetAttribute' => ['dr_coa_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_group' => Yii::t('app', 'Item Group'),
            'sub_group' => Yii::t('app', 'Sub Group'),
            'dr_coa_id' => Yii::t('app', 'Dr Coa ID'),
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
    public function getDrCoa()
    {
        return $this->hasOne(AmCoa::className(), ['id' => 'dr_coa_id']);
    }

    /**
     * @inheritdoc
     * @return ItImToApQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItImToApQuery(get_called_class());
    }
}
