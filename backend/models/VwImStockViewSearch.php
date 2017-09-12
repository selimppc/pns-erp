<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VwStockView;

class VwImStockViewSearch extends VwImStockView
{

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [            
            [['product_id','product_title','batch_number','expire_date', 'branch_id','sell_rate','sell_tax','im_rate','uom','batch_number','issueQty','saleQty','inhandQty','available','min_level'], 'safe'],
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
    	$query = VwImStockView::find();

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
            'product_id' => $this->product_id,
            'product_title' => $this->product_title,
            'batch_number' => $this->batch_number,
            'expire_date' => $this->expire_date,
            'branch_id' => $this->branch_id,
            'sell_rate' => $this->sell_rate,
            'sell_tax' => $this->sell_tax,
            'im_rate' => $this->im_rate,
            'uom' => $this->uom,
            'issueQty' => $this->issueQty,
            'saleQty' => $this->saleQty,
            'inhandQty' => $this->inhandQty,
            'available' => $this->available,
            'min_level' => $this->min_level
        ]);

        return $dataProvider;


    }


}