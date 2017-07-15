<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%it_im_gl}}".
 *
 * @property integer $id
 * @property integer $branch_id
 * @property string $transaction_code
 * @property string $group
 * @property integer $dr_coa_id
 * @property integer $cr_coa_id
 *
 * @property Branch $branch
 */
class ItImGl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%it_im_gl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_id', 'dr_coa_id', 'cr_coa_id'], 'integer'],
            [['transaction_code', 'group'], 'string', 'max' => 16],
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
            'branch_id' => Yii::t('app', 'Branch ID'),
            'transaction_code' => Yii::t('app', 'Transaction Code'),
            'group' => Yii::t('app', 'Group'),
            'dr_coa_id' => Yii::t('app', 'Dr Coa ID'),
            'cr_coa_id' => Yii::t('app', 'Cr Coa ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @inheritdoc
     * @return ItImGlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItImGlQuery(get_called_class());
    }
}
