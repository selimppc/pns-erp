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
            [['product_id','product_title','batch_number','expire_date', 'branch_id','sell_rate','sell_tax','im_rate','uom','batch_number','issueQty','saleQty','inhandQty','available','min_level','product_code','product_style','product_model','product_description'], 'safe'],
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
    	$query = VwImStockView::find()->groupBy(['product_id','branch_id'])->orderBy('product_id','asc');
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
       

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'product_title', $this->product_title])
            ->andFilterWhere(['like', 'product_style', $this->product_style])
            ->andFilterWhere(['like', 'product_model', $this->product_model])
            ->andFilterWhere(['like', 'product_description', $this->product_description])
            ->andFilterWhere(['like', 'batch_number', $this->batch_number])
            ->andFilterWhere(['like', 'expire_date', $this->expire_date])
            ->andFilterWhere(['like', 'branch_id', $this->branch_id])
            ->andFilterWhere(['like', 'sell_rate', $this->sell_rate])
            ->andFilterWhere(['like', 'sell_tax', $this->sell_tax])
            ->andFilterWhere(['like', 'im_rate', $this->im_rate])
            ->andFilterWhere(['like', 'uom', $this->uom])
            ->andFilterWhere(['like', 'available', $this->available])
            ->andFilterWhere(['like', 'min_level', $this->min_level])
            ->andFilterWhere(['like', 'issueQty', $this->issueQty])
            ->andFilterWhere(['like', 'saleQty', $this->saleQty])
            ->andFilterWhere(['like', 'inhandQty', $this->inhandQty]);

        return $dataProvider;


    }


}