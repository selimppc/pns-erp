<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AmVoucherDetail;

/**
 * AmVoucherDetailSearch represents the model behind the search form about `backend\models\AmVoucherDetail`.
 */
class AmVoucherDetailSearch extends AmVoucherDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'am_voucher_head_id', 'am_coa_id', 'currency_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['exchange_rate', 'prime_amount', 'base_amount'], 'number'],
            [['note', 'status', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AmVoucherDetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'am_voucher_head_id' => $this->am_voucher_head_id,
            'am_coa_id' => $this->am_coa_id,
            #'am_sub_coa_id' => $this->am_sub_coa_id,
            'currency_id' => $this->currency_id,
            'exchange_rate' => $this->exchange_rate,
            'prime_amount' => $this->prime_amount,
            'base_amount' => $this->base_amount,
            'branch_id' => $this->branch_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
