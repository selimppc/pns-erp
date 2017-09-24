<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SmHead;

/**
 * SmHeadSearch represents the model behind the search form about `backend\models\SmHead`.
 */
class SmHeadSearch extends SmHead
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'branch_id', 'am_coa_id', 'currency_id', 'created_by', 'updated_by'], 'integer'],
            [['sm_number', 'date', 'doc_type', 'check_number', 'note', 'sign', 'status', 'reference_code', 'gl_voucher_number', 'created_at', 'updated_at'], 'safe'],
            [['exchange_rate', 'tax_rate', 'tax_amount', 'discount_rate', 'discount_amount', 'prime_amount', 'net_amount'], 'number'],
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
    public function search($params,$sales_type='')
    {
        $query = SmHead::find();

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
            'customer_id' => $this->customer_id,
            'branch_id' => $this->branch_id,
            'am_coa_id' => $this->am_coa_id,
            'currency_id' => $this->currency_id,
            'exchange_rate' => $this->exchange_rate,
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

        if($sales_type == 'direct_sale'){
            $query->andFilterWhere(['like', 'sm_number', 'DS--']);
        }else{
            $query->andFilterWhere(['like', 'sm_number', 'IN--']);
        }

        $query->andFilterWhere(['like', 'doc_type', $this->doc_type])
            ->andFilterWhere(['like', 'check_number', $this->check_number])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'sign', $this->sign])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'reference_code', $this->reference_code])
            ->andFilterWhere(['like', 'gl_voucher_number', $this->gl_voucher_number]);

        return $dataProvider;
    }
}
