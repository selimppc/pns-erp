<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VwStockView;

class VwSmCustomerReceivableSearch extends VwSmCustomerReceivable
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['sm_head_id','customer_id','customer_code','customer_name', 'customer_group','branch_id','customer_address','customer_cell','customer_phone','receivable_amount'], 'safe'],
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
        $query = VwSmCustomerReceivable::find();
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
       

        $query->andFilterWhere(['like', 'sm_head_id', $this->sm_head_id])
            ->andFilterWhere(['like', 'customer_id', $this->customer_id])
            ->andFilterWhere(['like', 'customer_code', $this->customer_code])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'customer_group', $this->customer_group])
            ->andFilterWhere(['like', 'branch_id', $this->branch_id])
            ->andFilterWhere(['like', 'customer_address', $this->customer_address])
            ->andFilterWhere(['like', 'customer_cell', $this->customer_cell])
            ->andFilterWhere(['like', 'customer_phone', $this->customer_phone])
            ->andFilterWhere(['like', 'receivable_amount', $this->receivable_amount]);

        return $dataProvider;


    }


}