<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ImGrnHead;

/**
 * ImGrnHeadSearch represents the model behind the search form about `backend\models\ImGrnHead`.
 */
class ImGrnHeadSearch extends ImGrnHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pp_purchase_head_id', 'am_voucher_head_id', 'supplier_id', 'branch_id', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['grn_number', 'date', 'pay_terms', 'status', 'created_at', 'updated_at','voucher_number'], 'safe'],
            [['tax_rate', 'tax_amount', 'discount_rate', 'discount_amount', 'exchange_rate', 'prime_amount', 'net_amount'], 'number'],
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
        $query = ImGrnHead::find();

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

        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params)
         * statement below
         */

        $dataProvider->setSort([
            'attributes' => [
                'id' => [
                    'asc' => ['id' => SORT_ASC],
                    'desc' => ['id' => SORT_DESC],
                    'default' => SORT_DESC
                ],
                /*'name' => [
                    'asc' => ['date' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC],
                    'default' => SORT_ASC,
                ],*/
            ],
            'defaultOrder' => [
                'id' => SORT_DESC
            ]
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pp_purchase_head_id' => $this->pp_purchase_head_id,
            'am_voucher_head_id' => $this->am_voucher_head_id,
            'supplier_id' => $this->supplier_id,
            'date' => $this->date,
            'branch_id' => $this->branch_id,
            'tax_rate' => $this->tax_rate,
            'tax_amount' => $this->tax_amount,
            'discount_rate' => $this->discount_rate,
            'discount_amount' => $this->discount_amount,
            'currency_id' => $this->currency_id,
            'exchange_rate' => $this->exchange_rate,
            'prime_amount' => $this->prime_amount,
            'net_amount' => $this->net_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'grn_number', $this->grn_number])
            ->andFilterWhere(['like', 'pay_terms', $this->pay_terms])
            ->andFilterWhere(['like', 'voucher_number', $this->voucher_number])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
