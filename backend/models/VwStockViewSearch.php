<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VwStockView;

class VwStockViewSearch extends VwStockView
{
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['grn_number','supplier_id','date','pay_terms', 'branch_name','branch_code','status','title','product_code','batch_number','expire_date','receive_quantity','cost_price','uom','quantity','row_amount'], 'safe'],
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
    	$query = VwStockView::find();

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
            'grn_number' => $this->grn_number,
            'supplier_id' => $this->supplier_id,
            'date' => $this->date,
            'pay_terms' => $this->pay_terms,
            'branch_name' => $this->branch_name,
            'branch_code' => $this->branch_code,
            'status' => $this->status,
            'title' => $this->title,
            'product_code' => $this->product_code,
            'batch_number' => $this->batch_number,
            'expire_date' => $this->expire_date,
            'receive_quantity' => $this->receive_quantity,
            'cost_price' => $this->cost_price,
            'uom' => $this->uom,
            'quantity' => $this->quantity,
            'row_amount' => $this->row_amount
        ]);

        return $dataProvider;


    }
}