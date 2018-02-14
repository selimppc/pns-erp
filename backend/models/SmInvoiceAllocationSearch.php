<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VwStockView;

class SmInvoiceAllocationSearch extends SmInvoiceAllocation
{

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['sm_head_id','invoice_number','amount','balance_amount'], 'safe'],
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
    	$query = SmInvoiceAllocation::find();
        // ->groupBy('product_id,branch_id');

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
       

        $query->andFilterWhere(['like', 'balance_amount', $this->balance_amount])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'invoice_number', $this->invoice_number])
            ->andFilterWhere(['like', 'sm_head_id', $this->sm_head_id]);

        return $dataProvider;


    }


}