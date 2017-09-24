<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PpPurchaseHead;

/**
 * PpPurchaseHeadSearch represents the model behind the search form about `backend\models\PpPurchaseHead`.
 */
class PpPurchaseHeadSearch extends PpPurchaseHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'branch_id', 'created_by', 'updated_by'], 'integer'],
            [['po_order_number', 'date', 'pay_terms', 'delivery_date', 'status', 'created_at', 'updated_at','currency_id','exchange_rate','status'], 'safe'],
            [['tax_rate', 'tax_amount', 'discount_rate', 'discount_amount', 'prime_amount', 'net_amount'], 'number'],
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
        $query = PpPurchaseHead::find();

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
            'supplier_id' => $this->supplier_id,
            'currency_id' => $this->currency_id,
            'exchange_rate' => $this->exchange_rate,            
            'branch_id' => $this->branch_id,
            'tax_rate' => $this->tax_rate,
            'tax_amount' => $this->tax_amount,
            'discount_rate' => $this->discount_rate,
            'discount_amount' => $this->discount_amount,
            'prime_amount' => $this->prime_amount,
            'net_amount' => $this->net_amount,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'po_order_number', $this->po_order_number])
            ->andFilterWhere(['like', 'pay_terms', $this->pay_terms])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'delivery_date', $this->delivery_date])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
